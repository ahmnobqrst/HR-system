@extends('dashboard.includes.master')
@section('title')
{{ __('words.absent_employees') }}
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
            </tr>
            </thead>

            <tbody>
            @foreach($attendences_absent as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->user->getTranslation('name',app()->getLocale()) }}</td>
                    <td>{{ __('words.'.$item->status) }}</td>
                    <td>{{ $item->date }}</td>
                </tr>
            @endforeach
            </tbody>

        </table>
         <div class="mt-3 d-flex justify-content-center">
                {{ $attendences_absent->links() }}
            </div>
    </div>

</div>

@endsection
