@extends('dashboard.includes.master')
@section('title')
{{ __('words.Dashboard_employee') }}
@endsection

@push('css')
<style>
    .scrollable { height: 70vh; overflow: auto; }
    .table.fs-11 td { font-size: 11px !important; position: relative; }
    td.today { border: 8px solid #0b5ed7; border-width: medium; position: relative; }
    td.disabled { background: #cccccc; }
    span.mark-today { position: absolute; top: 0; left: 0; background: #0d6efd; color: #fff; padding: 2px 5px; font-size: 7px; border-radius: 0 0 5px; user-select: none; }

    /* ألوان الحالة */
    .status-present { background-color: #d4edda !important; color: #155724 !important; font-weight: bold; }
    .status-late { background-color: #fff3cd !important; color: #856404 !important; font-weight: bold; }
    .status-absent { background-color: #f8d7da !important; color: #721c24 !important; font-weight: bold; }

    @media screen and (max-width:767px){
        .table.fs-11 td { font-size: 8px !important; }
        .table td, .table th { padding: 5px; }
        .btn { font-size: 16px !important; padding: 6px!important; }
        h5 { font-size: 18px!important; margin-bottom: 0 !important; }
    }
</style>
@endpush

@section('content')
@php
    use Carbon\Carbon;

    $locale = app()->getLocale();
    $weekDays = [
        __('attendance.sunday'),
        __('attendance.monday'),
        __('attendance.tuesday'),
        __('attendance.wednesday'),
        __('attendance.thursday'),
        __('attendance.friday'),
        __('attendance.saturday'),
    ];

    $monthStart = Carbon::now()->startOfMonth();
    $monthEnd   = Carbon::now()->endOfMonth();
    $startWeekDay = $monthStart->dayOfWeek;
    $daysInMonth = $monthStart->daysInMonth;
@endphp

<div class="row">

    <!-- إجمالي الحضور -->
    <div class="col-xl-3 col-md-6">
        <div class="card custom-card card-bg-success">
            <div class="card-body d-flex align-items-center w-100">
                <span class="avatar avatar-rounded me-2"><i class="ri-user-2-fill text-white fs-40"></i></span>
                <div>
                    <div class="fs-15 fw-semibold">{{ $records->where('status','present')->count() }}</div>
                    <p class="mb-0 text-fixed-white op-7 fs-12">{{ __('attendance.total_present') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- إجمالي التأخير -->
    <div class="col-xl-3 col-md-6">
        <div class="card custom-card card-bg-warning">
            <div class="card-body d-flex align-items-center w-100">
                <span class="avatar avatar-rounded me-2"><i class="ri-time-fill text-white fs-40"></i></span>
                <div>
                    <div class="fs-15 fw-semibold">{{ $records->where('status','late')->count() }}</div>
                    <p class="mb-0 text-fixed-white op-7 fs-12">{{ __('attendance.total_late') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- إجمالي الغياب -->
    <div class="col-xl-3 col-md-6">
        <div class="card custom-card card-bg-danger">
            <div class="card-body d-flex align-items-center w-100">
                <span class="avatar avatar-rounded me-2"><i class="ri-user-unfollow-fill text-white fs-40"></i></span>
                <div>
                    <div class="fs-15 fw-semibold">
                        {{ $records->where('status','absent')->count() }}
                    </div>
                    <p class="mb-0 text-fixed-white op-7 fs-12">{{ __('attendance.total_absent') }}</p>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="row">

    <div class="col-lg-4 col-md-12 col-sm-12">
        <div class="card custom-card text-center">
            <div class="card-header">
                <div class="card-title">{{ __('attendance.attendance_title') }}</div>
            </div>
            <div class="card-body">

                @if(!$todayRecord)
                    <form action="{{ route('employee.attendance.checkin') }}" method="POST">
                        @csrf
                        <button class="btn btn-success w-100">{{ __('attendance.check_in') }}</button>
                    </form>

                @elseif($todayRecord && !$todayRecord->checkOut)
                    <h6>{{ __('attendance.checked_in') }}</h6>
                    <p class="h4 text-success"><i class="bx bx-check fa-4x"></i> {{ __('attendance.completed') }}</p>

                    <form action="{{ route('employee.attendance.checkout') }}" method="POST">
                        @csrf
                        <button class="btn btn-danger w-100">{{ __('attendance.check_out') }}</button>
                    </form>

                @else
                    <p class="h4 text-success"><i class="bx bx-check fa-4x"></i> {{ __('attendance.checked_out') }}</p>
                    <button class="btn btn-secondary w-100" disabled>{{ __('attendance.completed') }}</button>
                @endif
            </div>

            <div class="card-footer">
                @if($todayRecord && $todayRecord->worked_hours)
                    {{ __('attendance.worked_hours') }}: 
                    {{ $todayRecord->worked_hours }} {{ $locale=='ar'?'ساعة':'' }}
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered text-center fs-11">
                    <thead>
                        <tr>
                            @foreach($weekDays as $dayName)
                                <th>{{ $dayName }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>

                    @php $dayCounter = 1; @endphp

                    @for($row = 0; $row < 6; $row++)
                        <tr>
                            @for($col = 0; $col < 7; $col++)

                                @php
                                    $cellDay = null;
                                    if ($row === 0 && $col < $startWeekDay) {
                                        $cellDay = '';
                                    } elseif ($dayCounter <= $daysInMonth) {
                                        $cellDay = $dayCounter;
                                    } else {
                                        $cellDay = '';
                                    }

                                    $dateObj = $cellDay ? $monthStart->copy()->day($cellDay)->toDateString() : null;
                                    $record = $dateObj ? $records[$dateObj] ?? null : null;
                                    $isToday = $dateObj == $today;

                                    $statusClass = '';
                                    if ($record) {
                                        if ($record->status == 'present') $statusClass = 'status-present';
                                        elseif ($record->status == 'late') $statusClass = 'status-late';
                                        elseif ($record->status == 'absent') $statusClass = 'status-absent';
                                    }
                                @endphp

                                <td class="{{ $isToday ? 'today' : '' }} {{ $statusClass }}">
                                    @if($cellDay)
                                        @if($isToday)
                                            <span class="mark-today">{{ __('attendance.today') }}</span>
                                        @endif

                                        {{ $cellDay }} <br>

                                        @if($record)
                                            @if($record->status == 'present') {{ __('attendance.present') }}
                                            @elseif($record->status == 'late') {{ __('attendance.late') }}
                                            @elseif($record->status == 'absent') {{ __('attendance.absent') }}
                                            @endif
                                        @endif
                                    @endif
                                </td>

                                @php if ($cellDay) $dayCounter++; @endphp

                            @endfor
                        </tr>
                    @endfor

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

@endsection

@push('js')
<script>
    $(document).ready(function () {
        function updateDateTime() {
            const now = new Date();
            const locale = "{{ app()->getLocale() }}";
            let currentDateTime = now.toLocaleString(locale === 'ar' ? 'ar-EG' : 'en-US');
            let date = currentDateTime.split(',')[0];
            let time = currentDateTime.split(',')[1].trim();
            $('#time').html('<h5>' + date + '</h5><h6>' + time + '</h6>');
        }

        updateDateTime();
        setInterval(updateDateTime, 1000);
    });
</script>
@endpush
