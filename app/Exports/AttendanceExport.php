<?php

namespace App\Exports;

use App\Models\AttendenceRecords;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AttendanceExport implements FromCollection, WithHeadings
{
    protected $employeeIds;

    public function __construct($employeeIds)
    {
        $this->employeeIds = $employeeIds;
    }

    public function collection()
    {
        return AttendenceRecords::with('employee')
            ->whereIn('user_id', $this->employeeIds)
            ->orderBy('date', 'DESC')
            ->get()
            ->map(function ($record) {
                return [
                    'Employee Name' => $record->employee->name,
                    'Email' => $record->employee->email,
                    'Date' => $record->date,
                    'Status' => $record->status,
                    'Check In' => $record->check_in,
                    'Check Out' => $record->check_out,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Employee Name',
            'Email',
            'Date',
            'Status',
            'Check In',
            'Check Out',
        ];
    }
}
