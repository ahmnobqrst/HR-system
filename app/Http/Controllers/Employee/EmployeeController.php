<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{AttendenceRecords, Department, Holiday, EmployeeHoliday, LeaveBalances};
use Carbon\Carbon;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = auth()->id();
        $today = Carbon::today();
        $monthStart = now()->startOfMonth();
        $monthEnd = now()->endOfMonth();
        $records = AttendenceRecords::where('user_id', $userId)
            ->whereBetween('date', [$monthStart, $monthEnd])
            ->get()
            ->keyBy(fn($q) => Carbon::parse($q->date)->format('Y-m-d'));

        $todayRecord = $records->get($today->format('Y-m-d'));

        $calendar = [];
        $start = $monthStart->copy()->startOfWeek();
        $end = $monthEnd->copy()->endOfWeek();

        while ($start <= $end) {
            $day = $start->format('Y-m-d');
            $calendar[$day] = [
                'day' => $start->day,
                'isCurrentMonth' => $start->month == $monthStart->month,
                'isToday' => $start->isToday(),
                'record' => $records->get($day)
            ];
            $start->addDay();
        }
        $totalPresent = $records->where('status', 'present')->count();
        $totalLate    = $records->where('status', 'late')->count();
        $totalAbsent  = now()->daysInMonth - ($totalPresent + $totalLate);

        return view('Employee.dashboard', compact(
            'records',
            'today',
            'todayRecord',
            'calendar',
            'totalPresent',
            'totalLate',
            'totalAbsent'
        ));
    }

    public function get_employee_department()
    {
        $department = Department::findOrFail(auth()->user()->department_id);
        return view('Employee.department.index', compact('department'));
    }


    //==================================================== Attendences =====================================================//

    public function attendance_employee_history(Request $request)
    {
        $userId = auth()->id();
        $month = $request->input('month', now()->month);
        $year = $request->input('year', now()->year);
        $selectedDate = Carbon::createFromDate($year, $month, 1);
        $attendanceRecords = AttendenceRecords::where('user_id', $userId)
            ->whereYear('date', $year)
            ->whereMonth('date', $month)
            ->orderBy('date', 'desc')
            ->get();

        $totalMinutes = $attendanceRecords->sum('minutes_worked');
        $totalHours = floor($totalMinutes / 60);
        $availableMonths = [];
        $startDate = Carbon::create(2025, 5, 1);
        $endDate = Carbon::create(2025, 12, 31);

        $current = $startDate->copy();
        while ($current->lte($endDate)) {
            $availableMonths[] = [
                'month' => $current->month,
                'year' => $current->year,
                'label' => $current->format('Y-m')
            ];
            $current->addMonth();
        }

        return view('Employee.attendance_report', compact(
            'attendanceRecords',
            'totalHours',
            'selectedDate',
            'availableMonths',
            'month',
            'year'
        ));
    }

    //====================================================== Leaves ======================================================//
    public function get_employee_leaves()
    {
        $leaves = LeaveBalances::where('user_id', auth()->user()->id)->paginate(10);
        return view('Employee.leave.index', compact('leaves'));
    }

    public function get_form_creation()
    {
        return view('Employee.leave.create');
    }
    public function create_leave(Request $request)
    {
        $validated = $request->validate([
            'leave_type_en'     => 'required|string|max:255',
            'leave_type_ar'     => 'required|string|max:255',
            'balance_hours'     => 'required|numeric|min:0',
            'year'              => 'required|integer|min:2020|max:2100',
        ]);

        LeaveBalances::create([
            'user_id'        => auth()->user()->id,
            'leave_type'     => [
                'en' => $validated['leave_type_en'],
                'ar' => $validated['leave_type_ar'],
            ],
            'balance_hours'  => $validated['balance_hours'],
            'year'           => $validated['year'],
        ]);

        return back()->with('success', __('saved successfully'));
    }

    public function edit_employee_leave($id)
    {
        $leave = LeaveBalances::findOrFail($id);
        return view('Employee.leave.edit', compact('leave'));
    }
    public function update_employee_leave(Request $request, $id)
    {
        $validated = $request->validate([
            'leave_type_en'     => 'required|string|max:255',
            'leave_type_ar'     => 'required|string|max:255',
            'balance_hours'     => 'required|numeric|min:0',
            'year'              => 'required|integer|min:2025|max:2100',
        ]);

        $leave = LeaveBalances::findOrFail($id);
        $leave->user_id        = auth()->user()->id;
        $leave->leave_type    = [
            'en' => $validated['leave_type_en'],
            'ar' => $validated['leave_type_ar'],
        ];
        $leave->balance_hours = $validated['balance_hours'];
        $leave->year       = $validated['year'];

        $leave->save();

        return back()->with('success', __('saved successfully'));
    }
    public function delete_employee_leave(Request $request)
    {
        LeaveBalances::where('id', $request->id)->delete();
        toastr()->success(__('words.holiday_deleted_succe'));
        return redirect()->route('employee.all.leaves');
    }

    //=========================================== Employee Holidays ==========================================================//
    public function get_employee_holidays()
    {
        $leaves = EmployeeHoliday::where('user_id',auth()->user()->id)->paginate(10);
        return view('Employee.holiday.index', compact('leaves'));
    }

    public function get_creation_form()
    {
        return view('Employee.holiday.create');
    }

    public function create_holiday(Request $request)
    {
        $request->validate([
            'leave_type_ar' => 'required|string|max:255',
            'leave_type_en' => 'required|string|max:255',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'nullable|string|max:500',
        ]);

        $user = auth()->user();
        $department = $user->department_id;

        EmployeeHoliday::create([
            'user_id' => $user->id,
            'department_id' => $department,
            'leave_type' => [
                'ar' => $request->leave_type_ar,
                'en' => $request->leave_type_en
            ],
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'reason' => ['ar' => $request->reason_ar, 'en' => $request->reason_en],
            'status' => 'pendding',
        ]);

        return redirect()->route('get.employee.holidays')->with('success', __('words.leave_created_success'));
    }

    public function edit_employee_holiday($id)
    {
        $holiday = EmployeeHoliday::findOrFail($id);
        return view('Employee.holiday.edit', compact('holiday'));
    }

    public function update_employee_holiday(Request $request, $id)
    {
        try {
            $user = auth()->user();
            $department = $user->department_id;
            $holiday = EmployeeHoliday::findOrFail($id);

            $holiday->update([
                'user_id' => $user->id,
                'department_id' => $department,
                'leave_type' => [
                    'ar' => $request->leave_type_ar,
                    'en' => $request->leave_type_en
                ],
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'reason' => [
                    'ar' => $request->reason_ar,
                    'en' => $request->reason_en
                ],
                'status' => 'pendding',
            ]);

            toastr()->success(__('words.employee_updated_successfully'));
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function delete_employee_holiday(Request $request)
    {
        try {
            EmployeeHoliday::where('id', $request->id)->delete();
            toastr()->success(__('words.holiday_deleted_succe'));
            return redirect()->route('holidays.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function get_employee_official_holidays()
    {
        $holidays = Holiday::paginate(10);
        return view('Employee.holiday.formal-holiday', compact('holidays'));
    }
}
