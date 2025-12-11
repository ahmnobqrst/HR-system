@extends('dashboard.includes.master')
@section('title')
{{ __('words.late_employees') }}
@endsection
@section('content')

<div class="container-fluid">

    <div class="table-responsive mt-4">
        <table class="table table-bordered table-hover text-center">

            <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>{{ __('words.employee_name') }}</th>
                <th>{{ __('words.status') }}</th>
                <th>{{ __('words.date') }}</th>
                <th>{{ __('words.checkin') }}</th>
                <th>{{ __('words.minutes_worked') }}</th>
            </tr>
            </thead>

            <tbody>
            @foreach($attendences_late as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->user->getTranslation('name',app()->getLocale()) }}</td>
                    <td>{{ __('words.'.$item->status) }}</td>
                    <td>{{ $item->date }}</td>
                    <td>{{ $item->checkIn }}</td>
                    <td>{{ $item->minutes_worked }}</td>
                </tr>
            @endforeach
            </tbody>

        </table>
        <div class="mt-3 d-flex justify-content-center">
                {{ $attendences_late->links() }}
            </div>
    </div>

</div>

@endsection
