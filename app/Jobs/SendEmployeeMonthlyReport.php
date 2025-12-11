<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\AttendenceRecords;
use App\Models\EmployeeHoliday;
use App\Mail\MonthlyReportMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Twilio\Rest\Client;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;


class SendEmployeeMonthlyReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 300;

    public function __construct(
        public User $employee,
        public Carbon $month
    ) {}

    public function handle(): void
    {
        $start = $this->month->copy()->startOfMonth();
        $end   = $this->month->copy()->endOfMonth();
        $monthName = $this->month->translatedFormat('F Y');

        $attendances = AttendenceRecords::where('user_id', $this->employee->id)
            ->whereBetween('date', [$start, $end])
            ->get();

        $holidays = EmployeeHoliday::where('user_id', $this->employee->id)
            ->where('status', 'accepted')
            ->where(function ($q) use ($start, $end) {
                $q->whereBetween('start_date', [$start, $end])
                    ->orWhereBetween('end_date', [$start, $end])
                    ->orWhereRaw('? BETWEEN start_date AND end_date', [$start])
                    ->orWhereRaw('? BETWEEN start_date AND end_date', [$end]);
            })
            ->get();

        $baseSalary = $this->employee->salary ?? 0;
        $hourlyRate = $baseSalary > 0 ? $baseSalary / (22 * 8) : 0;
        $dailyRate  = $baseSalary > 0 ? $baseSalary / 22 : 0;

        $delayHours   = $attendances->sum('delay_hours') ?? 0;
        $earlyHours   = $attendances->sum('early_leave_hours') ?? 0;
        $overtime     = $attendances->sum('over_time') ?? 0;
        $absences     = $this->countAbsences($this->employee, $start, $end, $attendances);

        $deductions   = ($delayHours + $earlyHours) * $hourlyRate + $absences * $dailyRate;
        $otPay        = $overtime * $hourlyRate * 1.5;
        $netSalary    = $baseSalary - $deductions + $otPay;

        $vacations    = $holidays->where('leave_type', '!=', 'permission')->count();
        $permissions  = $holidays->where('leave_type', 'permission')->count();

        $data = [
            'month'          => $monthName,
            'name'           => $this->employee->name,
            'vacations'      => $vacations,
            'permissions'    => $permissions,
            'absences'       => $absences,
            'delay_hours'    => round($delayHours, 2),
            'early_hours'    => round($earlyHours, 2),
            'overtime_hours' => round($overtime, 2),
            'base_salary'    => $baseSalary,
            'deductions'     => round($deductions, 2),
            'ot_pay'         => round($otPay, 2),
            'net_salary'     => round($netSalary, 2),
        ];

        $pdf = Pdf::loadView('reports.monthly', $data);
        $fileName = "report_{$this->employee->id}_{$this->month->format('Y_m')}.pdf";
        $path = "reports/{$fileName}";
        Storage::put($path, $pdf->output());

        Mail::to($this->employee->email)->queue(new MonthlyReportMail($data, $path));

        $this->sendWhatsApp($data, $path);
    }

    private function sendWhatsApp(array $data, string $pdfPath): void
    {
        if (!$this->employee->phone) {
            return;
        }
        $cleanPhone = preg_replace('/[^0-9]/', '', $this->employee->phone);
        if (str_starts_with($cleanPhone, '01')) {
            $cleanPhone = '20' . substr($cleanPhone, 1);
        }
        elseif (str_starts_with($cleanPhone, '1') && strlen($cleanPhone) === 11) {
            $cleanPhone = '20' . $cleanPhone;
        }

        $toNumber = 'whatsapp:+' . $cleanPhone;

        $fromNumber = config('services.twilio.whatsapp_from');

        $twilio = new \Twilio\Rest\Client(config('services.twilio.sid'), config('services.twilio.token'));

        $message = "تقريرك الشهري – {$data['month']}\n\n" .
            "الاسم: {$data['name']}\n" .
            "إجازات: {$data['vacations']}\n" .
            "إذونات: {$data['permissions']}\n" .
            "غيابات: {$data['absences']}\n" .
            "تأخير: {$data['delay_hours']} س\n" .
            "انصراف مبكر: {$data['early_hours']} س\n" .
            "الراتب الصافي: {$data['net_salary']} ج.م\n\n" .
            "التفاصيل في الـ PDF المرفق";

        try {
            $twilio->messages->create($toNumber, [
                'from' => $fromNumber,
                'body' => $message
            ]);

            $twilio->messages->create($toNumber, [
                'from' => $fromNumber,
                'mediaUrl' => [url(Storage::url($pdfPath))]
            ]);
        } catch (\Exception $e) {
            Log::error('WhatsApp Failed: ' . $e->getMessage());
        }
    }

    private function countAbsences(User $emp, Carbon $start, Carbon $end, $attend): int
    {
        $workingDays = 0;
        $current = $start->copy();

        while ($current->lte($end)) {
            if ($this->isWorkingDay($emp, $current)) $workingDays++;
            $current->addDay();
        }

        $presentDays = $attend->whereIn('status', ['present', 'late', 'early_leave'])->count();
        return $workingDays - $presentDays;
    }

    private function isWorkingDay(User $emp, Carbon $date): bool
    {
        $days = $emp->workSchedule?->weekly_working_days
            ? json_decode($emp->workSchedule->weekly_working_days, true)
            : ['Sunday', 'Monday', 'Tuesday', 'Wednesday','Thursday'];

        return in_array($date->englishDayOfWeek, $days);
    }
}
