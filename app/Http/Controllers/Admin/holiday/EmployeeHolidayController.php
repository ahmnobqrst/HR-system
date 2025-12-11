<?php

namespace App\Http\Controllers\Admin\holiday;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{EmployeeHoliday, Holiday};
use App\Traits\{image, helperTarit};

class EmployeeHolidayController extends Controller
{
    use helperTarit;
    public function index()
    {
        $employees = $this->getDepartmentEmployees();
        $leaves = EmployeeHoliday::with('user', 'department')
            ->whereIn('user_id', $employees->pluck('id'))
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('Admin.holiday.index', compact('leaves'));
    }

    public function create()
    {
        return view('Admin.holiday.create');
    }

    public function store(Request $request)
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

        return redirect()->route('holidays.index')->with('success', __('words.leave_created_success'));
    }

    public function show(string $id)
    {
        //
    }


    public function edit($id)
    {
        $holiday = EmployeeHoliday::findOrFail($id);
        return view('Admin.holiday.edit', compact('holiday'));
    }

    public function update(Request $request, $id)
    {
        try {
            $user = auth()->user();
            $department = $user->department_id;
            $holiday = EmployeeHoliday::findOrFail($id);

            $holiday->update([
                'user_id' => $user->id,
                'department_id'=>$department,
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


    public function destroy(Request $request)
    {
       try{
        EmployeeHoliday::where('id',$request->id)->delete();
        toastr()->success(__('words.holiday_deleted_succe'));
        return redirect()->route('holidays.index');
       } 
       catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function get_admin_holidays()
    {
        $admin_holidays = EmployeeHoliday::where('user_id', auth()->user()->id)->paginate(10);
        return view('Admin.holiday.admin-holiday', compact('admin_holidays'));
    }

    public function get_official_holidays()
    {
        $holidays = Holiday::paginate(10);
        return view('Admin.holiday.formal-holiday', compact('holidays'));
    }

    public function approve($id)
    {
        $holiday = EmployeeHoliday::FindOrFail($id);
        $holiday->update([
            'status' => 'accepted'
        ]);

        return back()->with('success', __('words.Leave_accepted'));
    }

    public function reject($id)
    {
        $holiday = EmployeeHoliday::FindOrFail($id);
        $holiday->update([
            'status' => 'rejected'
        ]);

        return back()->with('success', __('words.Leave_rejected'));
    }
}
