<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\{DepartmentRequest, EmployeeRequest};
use App\Interface\SuperAdmin\SuperAdminInterface;
use App\Models\User;
use App\Models\EmployeeHoliday;
use App\Models\LeaveBalances;
use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    public $superadmin;
    public function __construct(SuperAdminInterface $superadmin)
    {
        return $this->superadmin = $superadmin;
    }
    public function index()
    {
        return $this->superadmin->index();
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function get_all_departments()
    {
        return $this->superadmin->get_all_departments();
    }
    public function get_all_employees()
    {
        return $this->superadmin->get_all_employees();
    }
    public function get_all_present_employees()
    {
        return $this->superadmin->get_all_present_employees();
    }
    public function get_all_absent_employees()
    {
        return $this->superadmin->get_all_absent_employees();
    }
    public function get_all_lats_employees()
    {
        return $this->superadmin->get_all_lats_employees();
    }
    public function get_one_department($id)
    {
        return $this->superadmin->get_one_department($id);
    }

    public function update_department(DepartmentRequest $request, $id)
    {
        return $this->superadmin->update_department($request, $id);
    }
    public function delete_department(Request $request)
    {
        return $this->superadmin->delete_department($request);
    }
    public function add_department(DepartmentRequest $request)
    {
        return $this->superadmin->add_department($request);
    }
    public function create_department()
    {
        return $this->superadmin->create_department();
    }


    //=========================================== Emlpoyee ====================================//
    public function show_employee($id)
    {
        return $this->superadmin->show_employee_date($id);
    }
    public function get_create_employee()
    {
        return $this->superadmin->get_form_creation();
    }
    public function add_employee(EmployeeRequest $request)
    {
        return $this->superadmin->add_employee_data($request);
    }
    public function edit_employee($id)
    {
        return $this->superadmin->edit_employee($id);
    }
    public function update_employee(EmployeeRequest $request, $id)
    {
        return $this->superadmin->update_employee($request, $id);
    }
    public function delete_employee(Request $request)
    {
        return $this->superadmin->delete_employee($request);
    }

    //===================================== End Employees =====================================//



    //==================================== Attendeneces ======================================//

    public function report(Request $request)
    {
        return $this->superadmin->report($request);
    }

    public function export()
    {
        return $this->superadmin->export();
    }
    //==================================== End Attendences ===============================//


    //=================================== LeavesBalance =================================//
    public function get_all_leaves()
    {
        return $this->superadmin->get_all_leaves();
    }

    public function approve_leaves($id)
    {
        $leave = LeaveBalances::findOrFail($id);

        $leave->update([
            'status' => 'accepted'
        ]);

        return back()->with('success', __('words.Leave_accepted'));
    }

    public function reject_leaves($id)
    {
        
        $leave = LeaveBalances::findOrFail($id);

        $leave->update([
            'status' => 'rejected'
        ]);

        return back()->with('success', __('words.Leave_rejected'));
    }

    public function delete_all_leaves(Request $request, $id)
    {
        try {
            LeaveBalances::where('id', $id)->delete();
            toastr()->success(__('words.holiday_deleted_succe'));
            return redirect()->route('all.leaves');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    //=================================== End LeavesBalance =================================//


    //=================================== Holidays =================================//
    public function get_all_employee_holidays()
    {
        $user = auth()->user();
        $leaves = EmployeeHoliday::with('user', 'department')
            ->orderBy('start_date', 'desc')
            ->paginate(15);

        return view('SuperAdmin.holiday.index', compact('leaves'));
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

    public function delete_admin_holiday(Request $request, $id)
    {
        try {
            EmployeeHoliday::where('id', $id)->delete();
            toastr()->success(__('words.holiday_deleted_succe'));
            return redirect()->route('get.all_employee.holidays');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    //=================================== End Hoildays =================================//


}
