@extends('dashboard.includes.master')
@section('title')
{{ __('attendance.attendance_report_title') }}
@endsection

@push('css')
<style>
    .status-present { color: #155724; font-weight: bold; }
    .status-late { color: #856404; font-weight: bold; }
    .status-absent { color: #721c24; font-weight: bold; }

    .month-btn {
        margin: 3px;
        min-width: 90px;
    }

    .table th, .table td { text-align: center; vertical-align: middle; }
</style>
@endpush

@section('content')
<div class="page-content">
    <div class="row">
        <div class="card custom-card">
            <div class="card-header justify-content-between">
                <div class="card-title">{{ __('attendance.attendance_report_title') }}</div>
            </div>

            <div class="card-body">

                <!-- أزرار الشهور -->
                <div class="mb-3">
                    @foreach($availableMonths as $m)
                        <a href="{{ route('employee.attendance.history', ['month' => $m['month'], 'year' => $m['year']]) }}"
                           class="btn btn-outline-primary month-btn {{ ($month == $m['month'] && $year == $m['year']) ? 'active' : '' }}">
                           {{ $m['label'] }}
                        </a>
                    @endforeach
                </div>

                <table class="table table-bordered text-nowrap" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>{{ __('attendance.date') }}</th>
                            <th>{{ __('attendance.status') }}</th>
                            <th>{{ __('attendance.day_name') }}</th>
                            <th>{{ __('attendance.day_type') }}</th>
                            <th>{{ __('attendance.check_in') }}</th>
                            <th>{{ __('attendance.check_out') }}</th>
                            <th>{{ __('attendance.worked_hours') }}</th>
                            <th>{{ __('attendance.overtime') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($attendanceRecords as $record)
                            @php
                                $statusClass = '';
                                if($record->status == 'present') $statusClass = 'status-present';
                                elseif($record->status == 'late') $statusClass = 'status-late';
                                elseif($record->status == 'absent') $statusClass = 'status-absent';

                                $dayName = \Carbon\Carbon::parse($record->date)->locale(app()->getLocale())->isoFormat('dddd');
                                $dayType = $record->is_holiday ? __('attendance.holiday') : __('attendance.work_day');
                                $checkIn = $record->checkIn ? \Carbon\Carbon::parse($record->checkIn)->format('h:i A') : '-';
                                $checkOut = $record->checkOut ? \Carbon\Carbon::parse($record->checkOut)->format('h:i A') : '-';
                                $workedHours = $record->worked_hours ? floor($record->worked_hours) . ' ' . __('attendance.hour') . ' ' . (($record->worked_hours*60)%60) . ' ' . __('attendance.minute') : '-';
                                $overtime = $record->over_time ? floor($record->over_time) . ' ' . __('attendance.hour') . ' ' . (($record->over_time*60)%60) . ' ' . __('attendance.minute') : '-';
                            @endphp
                            <tr>
                                <td>{{ $record->date }}</td>
                                <td class="{{ $statusClass }}">
                                    @if($record->status == 'present') <i class="ri-check-double-fill"></i> {{ __('attendance.present') }}
                                    @elseif($record->status == 'late') <i class="ri-time-fill"></i> {{ __('attendance.late') }}
                                    @elseif($record->status == 'absent') <i class="ri-close-circle-fill"></i> {{ __('attendance.absent') }}
                                    @endif
                                </td>
                                <td>{{ $dayName }}</td>
                                <td>{{ $dayType }}</td>
                                <td>{{ $checkIn }}</td>
                                <td>{{ $checkOut }}</td>
                                <td>{{ $workedHours }}</td>
                                <td>{{ $overtime }}</td>
                            </tr>
                        @endforeach

                        <tr>
                            <td colspan="4" class="text-center fw-bold">{{ __('attendance.total_hours') }}: {{ $totalHours }} {{ __('attendance.hour') }}</td>
                            <td colspan="4" class="text-center fw-bold">{{ __('attendance.total_overtime') }}: {{ $attendanceRecords->sum('over_time') }} {{ __('attendance.hour') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
