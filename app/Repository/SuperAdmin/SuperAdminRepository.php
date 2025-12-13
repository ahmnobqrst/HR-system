<?php

namespace App\Repository\SuperAdmin;

use App\Interface\SuperAdmin\SuperAdminInterface;
use App\Models\{AttendenceRecords, Department, User, WorkSchedules, LeaveBalances};
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Traits\image;
use App\Exports\AttendanceExport;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;

class SuperAdminRepository implements SuperAdminInterface
{
    use image;

    public function index()
    {
        $data['departments'] = Department::all();
        $data['employees'] = User::whereDoesntHave('roles', function ($q) {
            $q->where('name', 'superadmin');
        })->get();
        $data['attendences'] = AttendenceRecords::where('status', 'present');
        $data['absents'] = AttendenceRecords::where('status', 'absent');
        $data['lats'] = AttendenceRecords::where('status', 'late');
        return view('SuperAdmin.dashboard', $data);
    }

    //=============================== Depratment ======================================//

    public function get_all_departments()
    {
        $departments = Department::paginate(10);
        return view('SuperAdmin.department.index', compact('departments'));
    }
    public function get_all_employees()
    {
        $employees = User::whereDoesntHave('roles', function ($q) {
            $q->where('name', 'superadmin');
        })->paginate(10);

        return view('SuperAdmin.employee.index', compact('employees'));
    }
    public function get_all_present_employees()
    {
        $attendences_present = AttendenceRecords::where('status', 'present')->paginate(10);
        return view('SuperAdmin.attendence.present', compact('attendences_present'));
    }
    public function get_all_absent_employees()
    {
        $attendences_absent = AttendenceRecords::where('status', 'absent')->paginate(10);
        return view('SuperAdmin.attendence.absent', compact('attendences_absent'));
    }
    public function get_all_lats_employees()
    {
        $attendences_late = AttendenceRecords::where('status', 'late')->paginate(10);
        return view('SuperAdmin.attendence.late', compact('attendences_late'));
    }
    public function get_one_department($id)
    {
        $department = Department::findOrFail($id);
        $admins = User::whereHas('roles', function ($q) {
            $q->where('name', 'admin');
        })->paginate(10);
        return view('SuperAdmin.department.edit', compact('department', 'admins'));
    }
    public function update_department($request, $id)
    {
        try {
            $department = Department::findOrFail($id);
            $department->name = ['ar' => $request->name_ar, 'en' => $request->name_en];
            $department->description = ['ar' => $request->description_ar, 'en' => $request->description_en];
            $department->user_id = $request->user_id;
            $department->save();

            toastr()->success(trans('words.department_updated'));
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function delete_department($request)
    {
        try {
            $department = Department::findOrFail($request->id);
            $department->delete();
            toastr()->success(trans('words.department_Deleted'));
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function add_department($request)
    {
        try {
            $departments = Department::create([
                'name' => ['ar' => $request->name_ar, 'en' => $request->name_en],
                'description' => ['ar' => $request->description_ar, 'en' => $request->description_en],
                'user_id' => $request->user_id,
            ]);

            toastr()->success(trans('words.department_added'));
            return redirect()->route('get.all.departments');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function create_department()
    {
        try {
            $admins = User::whereHas('roles', function ($q) {
                $q->where('name', 'admin');
            })->get();
            return view('SuperAdmin.department.create', compact('admins'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    //=================================== End Department ===========================//


    //=================================== Employees ===========================//
    public function show_employee_date($id)
    {
        try {
            $employee = User::findOrFail($id);
            // $employee = User::whereDoesntHave('roles', function ($q) {
            //     $q->where('name', 'superadmin');
            // })->findOrFail($id);

            return view('SuperAdmin.employee.all_date_of_employee', compact('employee'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function get_form_creation()
    {
        try {
            $departments  = Department::all();
            $work_schedules = WorkSchedules::all();
            return view('SuperAdmin.employee.create', compact('departments', 'work_schedules'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function add_employee_data($request)
    {
        try {
            if ($request->hasFile('image') && $request->image != null) {
                $image = $this->uploadImageimage($request->image, 'Employees');
            }
            $employee = User::create([

                'name'              => ['ar' => $request->name_ar, 'en' => $request->name_en],
                'email'             => $request->email,
                'password'          => bcrypt($request->password),
                'employee_number'   => $request->employee_number,
                'address' => [
                    'ar' => $request->address_ar,
                    'en' => $request->address_en,
                ],
                'phone'         => $request->phone,
                'age'           => $request->age,
                'gender'        => $request->gender,

                'job_title' => [
                    'ar' => $request->job_title_ar,
                    'en' => $request->job_title_en,
                ],
                'birthdate'       => $request->birthdate,
                'department_id'   => $request->department_id,
                'work_schedule_id' => $request->work_schedule_id,
                'image' => $image,
                'salary'=>$request->salary,

            ]);

            if ($request->has('is_manager') && $request->is_manager) {
                $employee->assignRole('Admin');
            } else {
                $employee->assignRole('Employee');
            }

            return redirect()->route('get.all.employees');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit_employee($id)
    {
        try {
            $employee = User::findOrFail($id);
            $departments = Department::all();
            $work_schedules = WorkSchedules::all();
            return view('SuperAdmin.employee.edit', compact('employee', 'departments', 'work_schedules'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function update_employee($request, $id)
    {
        try {
            $employee = User::findOrFail($id);
            $employee->name = [
                'ar' => $request->name_ar,
                'en' => $request->name_en
            ];
            $employee->email = $request->email;
            $employee->employee_number = $request->employee_number;
            $employee->address = [
                'ar' => $request->address_ar,
                'en' => $request->address_en
            ];
            $employee->phone = $request->phone;
            $employee->age = $request->age;
            $employee->gender = $request->gender;
            $employee->job_title = [
                'ar' => $request->job_title_ar,
                'en' => $request->job_title_en
            ];
            $employee->birthdate = $request->birthdate;
            $employee->department_id = $request->department_id;
            $employee->work_schedule_id = $request->work_schedule_id;
            $employee->salary = $request->salary;

            if ($request->filled('password')) {
                $employee->password = Hash::make($request->password);
            }

            if ($request->hasFile('image')) {
                $this->delete_file($employee->image);

                $file = $request->file('image');
                $image = $this->uploadImageimage($file, 'Employees');

                $employee->image = $image;
            } else {
                $image = $employee->image;
            }




            $employee->save();
            toastr()->success(trans('words.employee_updated_successfully'));

            return redirect()->route('get.all.employees');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function delete_employee($request)
    {
        try {
            User::where('id', $request->id)->delete();
            toastr()->success(__('words.employee_deleted'));
            return redirect()->route('get.all.employees');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    //=================================== End Employees ===========================//


    //======================================== Attendeneces ==================================//
    public function report($request)
    {
        $attendances = AttendenceRecords::with('employee')
            ->orderBy('date', 'DESC')
            ->paginate(20);

        return view('SuperAdmin.attendence.report', compact('attendances'));
    }

    public function export()
    {
        return Excel::download(new AttendanceExport, 'attendance.xlsx');
    }
    // ==================================== End Attendences ============================================//


    // ==================================== LeaveBalance ============================================//
    public function get_all_leaves()
    {
        $leaves = LeaveBalances::with('user')->paginate(10);
        return view('SuperAdmin.leaves.index', compact('leaves'));
    }
    // ==================================== End LeaveBalance ============================================//
}
