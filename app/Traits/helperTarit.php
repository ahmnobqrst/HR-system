<?php

namespace App\Traits;

use App\Models\Department;
use App\Models\User;

trait helperTarit
{
    
    public function getUserDepartment()
    {
        return Department::where('user_id', auth()->id())->first();
    }

    public function getDepartmentEmployees()
    {
        $department = $this->getUserDepartment();
        if (!$department) {
            return collect();
        }

        return User::where('department_id', $department->id)
            ->whereHas('roles', function ($q) {
                $q->where('name', 'Employee');
            })
            ->get();
    }

    public function getDepartmentAttendance($status = null)
    {
        $employees = $this->getDepartmentEmployees();
        $query = \App\Models\AttendenceRecords::whereIn('user_id', $employees->pluck('id'));

        if ($status) {
            $query->where('status', $status);
        }

        return $query->paginate(10);
    }
}
