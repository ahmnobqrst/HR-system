@extends('dashboard.includes.master')
@section('title')
{{ __('words.Detailed-Attendance-Report') }}
@endsection

@section('content')

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">

        <a href="{{ route('attendance.report.export') }}" class="btn btn-success">
            <i class="ri-download-fill"></i> Export Excel
        </a>
    </div>


    <table class="table table-hover table-bordered">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Employee</th>
                <th>Phone</th>
                <th>Date</th>
                <th>Check In</th>
                <th>Check Out</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            @foreach($attendances as $key => $att)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $att->employee->name }}</td>
                <td>{{ $att->employee->phone }}</td>
                <td>{{ $att->date }}</td>
                <td>{{ $att->check_in }}</td>
                <td>{{ $att->check_out }}</td>
                <td>{{ $att->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-3 d-flex justify-content-center">
                {{ $attendances->links() }}
            </div>

</div>

@endsection
