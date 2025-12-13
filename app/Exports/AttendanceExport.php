<?php

namespace App\Exports;

use App\Models\AttendenceRecords;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AttendanceExport implements FromCollection, WithHeadings
{
    protected $employeeIds;

    // الآن $employeeIds اختياري
    public function __construct($employeeIds = null)
    {
        $this->employeeIds = $employeeIds;
    }

    public function collection()
    {
        $query = AttendenceRecords::with('employee')->orderBy('date', 'DESC');

        // إذا تم تمرير IDs، فلتر حسبهم
        if (!empty($this->employeeIds)) {
            $query->whereIn('user_id', $this->employeeIds);
        }

        return $query->get()->map(function ($record) {
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
