<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{AttendenceRecords, Department, User, WorkSchedules, LeaveBalances};
use App\Traits\{image, helperTarit};
use App\Exports\AttendanceExport;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class AdminController extends Controller
{
    use helperTarit;

    public function index()
    {
        $department   = $this->getUserDepartment();
        $employees    = $this->getDepartmentEmployees();
        $attendences  = $this->getDepartmentAttendance('present');
        $absents      = $this->getDepartmentAttendance('absent');
        $lates        = $this->getDepartmentAttendance('late');

        return view('Admin.dashboard', compact(
            'department',
            'employees',
            'attendences',
            'absents',
            'lates'
        ));
    }

    public function get_department()
    {
        $department = Department::where('user_id', auth()->user()->id)->first();
        return view('Admin.department.index', compact('department'));
    }

    //====================================== Employees ============================================================//
    public function get_department_employees()
    {
        $user = auth()->user();
        $department = Department::where('user_id', $user->id)->first();

        $employees = collect();
        if ($department) {
            $employees = User::where('department_id', $department->id)
                ->whereHas('roles', function ($q) {
                    $q->where('name', 'Employee');
                })
                ->paginate(10);
        }

        return view('Admin.employee.index', compact('employees'));
    }


    public function show_employee($id)
    {
        try {
            $user = auth()->user();
            $department = Department::where('user_id', $user->id)->first();

            $employee = User::where('department_id', $department->id)
                ->whereHas('roles', function ($q) {
                    $q->where('name', 'Employee');
                })->findOrFail($id);
            return view('Admin.employee.all_date_of_employee', compact('employee'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    //========================================== Attendences ===================================================//
    public function get_all_present_employees()
    {
        $attendences_present = $this->getDepartmentAttendance('present');
        return view('Admin.attendence.present', compact('attendences_present'));
    }
    public function get_all_absent_employees()
    {
        $attendences_absent = $this->getDepartmentAttendance('absent');
        return view('Admin.attendence.absent', compact('attendences_absent'));
    }
    public function get_all_lats_employees()
    {
        $attendences_late = $this->getDepartmentAttendance('late');
        return view('Admin.attendence.late', compact('attendences_late'));
    }

    public function report()
    {
        $employees = $this->getDepartmentEmployees();

        $attendances = AttendenceRecords::with('employee')
            ->whereIn('user_id', $employees->pluck('id'))
            ->orderBy('date', 'DESC')
            ->paginate(10);

        return view('Admin.attendence.report', compact('attendances'));
    }

    public function export()
    {
        $employees = $this->getDepartmentEmployees();

        return Excel::download(new AttendanceExport($employees->pluck('id')), 'attendance.xlsx');
    }



    //============================================= Leaves ===============================================//

    public function get_all_leaves()
    {
        $employees = $this->getDepartmentEmployees();
        $leaves = LeaveBalances::with('user')
            ->whereIn('user_id', $employees->pluck('id'))
            ->paginate(10);
        return view('Admin.leaves.index', compact('leaves'));
    }

    public function get_admin_leaves()
    {
        $leaves = LeaveBalances::where('user_id', auth()->user()->id)->paginate(10);
        return view('Admin.leaves.admin-leaves', compact('leaves'));
    }

    public function get_form_creation()
    {
        return view('Admin.leaves.create');
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

    public function edit_admin_leave($id)
    {
        $leave = LeaveBalances::findOrFail($id);
        return view('Admin.leaves.edit', compact('leave'));
    }
    public function update_admin_leave(Request $request, $id)
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
    public function delete_admin_leave(Request $request)
    {
        LeaveBalances::where('id', $request->id)->delete();
        toastr()->success(__('words.holiday_deleted_succe'));
        return redirect()->route('admin.admin.leaves');
    }

    public function approve($id)
    {
        $leave = LeaveBalances::findOrFail($id);

        $leave->update([
            'status' => 'accepted'
        ]);

        return back()->with('success', __('words.Leave_accepted'));
    }

    public function reject($id)
    {
        $leave = LeaveBalances::findOrFail($id);

        $leave->update([
            'status' => 'rejected'
        ]);

        return back()->with('success', __('words.Leave_rejected'));
    }

    public function delete_employee_leave(Request $request, $id)
    {
        try {
            LeaveBalances::where('id', $id)->delete();
            toastr()->success(__('words.holiday_deleted_succe'));
            return redirect()->route('admin.all.leaves');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }



    //============================================= Attendences For Admin ======================================================//
    public function attendance_page()
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

        return view('Admin.register', compact(
            'records',
            'today',
            'todayRecord',
            'calendar',
            'totalPresent',
            'totalLate',
            'totalAbsent'
        ));
    }



    public function attendance_checkin()
    {
        $officialStart = today()->setTime(9, 0, 0);
        $now = now();

        $delayMinutes = $now->greaterThan($officialStart)
            ? $officialStart->diffInMinutes($now)
            : 0;
        $delayHours = round($delayMinutes / 60, 2);

        $status = $delayMinutes >= 30 ? 'late' : 'present';

        AttendenceRecords::updateOrCreate(
            ['user_id' => auth()->id(), 'date' => today()],
            [
                'checkIn' => $now,
                'status'  => $status,
                'delay_hours' => $delayHours
            ]
        );

        return back();
    }

    public function attendance_checkout()
    {
        $record = AttendenceRecords::where('user_id', auth()->id())
            ->whereDate('date', today())
            ->first();

        if ($record && $record->checkIn) {

            $now = now();
            $officialEnd = today()->setTime(17, 0, 0);
            $workedMinutes = $record->checkIn->diffInMinutes($now);
            $workedHours = round($workedMinutes / 60, 2);
            $earlyLeaveMinutes = $now->lessThan($officialEnd)
                ? $now->diffInMinutes($officialEnd)
                : 0;
            $earlyLeaveHours = round($earlyLeaveMinutes / 60, 2);
            $overTimeMinutes = $now->greaterThan($officialEnd)
                ? $officialEnd->diffInMinutes($now)
                : 0;
            $overTimeHours = round($overTimeMinutes / 60, 2);

            $record->update([
                'checkOut' => $now,
                'worked_hours' => $workedHours,
                'early_leave_hours' => $earlyLeaveHours,
                'over_time' => $overTimeHours,
            ]);
        }

        return back();
    }


    public function attendanceHistory(Request $request)
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

        return view('Admin.attendance_report', compact(
            'attendanceRecords',
            'totalHours',
            'selectedDate',
            'availableMonths',
            'month',
            'year'
        ));
    }
}
