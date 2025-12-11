@extends('dashboard.includes.master')

@section('title', __('words.Official_Holidays'))

@section('content')
<div class="card">

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ __('words.Holiday_Date') }}</th>
                        <th>{{ __('words.Name') }}</th>
                        <th>{{ __('words.Description') }}</th>
                        <th>{{ __('words.Recurring') }}</th>
                        <th>{{ __('words.Created_At') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($holidays as $holiday)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ \Carbon\Carbon::parse($holiday->holiday_date)->format('Y-m-d') }}</td>
                        <td>{{ $holiday->name }}</td>
                        <td>{{ $holiday->description ?? '-' }}</td>
                        <td>
                            @if($holiday->recurring)
                                <span class="badge bg-success">{{ __('words.Yes') }}</span>
                            @else
                                <span class="badge bg-secondary">{{ __('words.No') }}</span>
                            @endif
                        </td>
                        <td>{{ $holiday->created_at->format('Y-m-d') }}</td>
                    </tr>
                    @endforeach
                    @if($holidays->isEmpty())
                    <tr>
                        <td colspan="7">{{ __('words.No_Data_Found') }}</td>
                    </tr>
                    @endif
                </tbody>
            </table>
            <div class="mt-3 d-flex justify-content-center">
                {{ $holidays->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
