@extends('dashboard.includes.master')

@section('title', trans('words.All_leaves'))

@section('content')

<div class="card">
    <div class="card-header">
        <a class="btn btn-primary top-btn" href="{{route('holidays.create')}}">
            {{ __('words.add_holidays') }}
        </a>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ trans('words.Employee_Name') }}</th>
                        <th>{{ trans('words.Leave_Type') }}</th>
                        <th>{{ trans('words.start_date') }}</th>
                        <th>{{ trans('words.end_date') }}</th>
                        <th>{{ trans('words.reason') }}</th>
                        <th>{{ trans('words.status') }}</th>
                        <th>{{ trans('words.Created_At') }}</th>
                        <th>{{ trans('words.action') }}</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($admin_holidays as $leave)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $leave->user?->name }}</td>

                        <td>{{ $leave->getTranslation('leave_type', app()->getLocale()) }}</td>

                        <td>{{ $leave->start_date }}</td>

                        <td>{{ $leave->end_date }}</td>
                        <td>{{ $leave->getTranslation('reason', app()->getLocale()) }}</td>
                        <td>
                            @php
                            $statusClass = match($leave->status) {
                            'accepted' => 'btn btn-success btn-sm',
                            'rejected' => 'btn btn-danger btn-sm',
                            default => 'btn btn-warning btn-sm',
                            };
                            @endphp
                            <span class="{{ $statusClass }}">{{ $leave->status }}</span>
                        </td>

                        <td>{{ $leave->created_at->format('Y-m-d') }}</td>

                        <td>
                            @if($leave->status == 'pendding')
                            <a class="btn btn-sm btn-warning" href="{{route('holidays.edit',$leave->id)}}">
                                {{ __('words.edit') }}
                            </a>
                            <form action="{{ route('delete.employee', $leave->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                <input type="hidden" name="id" value="{{$leave->id}}" />
                                <button type="submit" class="btn btn-sm btn-danger action-btn" onclick="return confirm('{{ __('words.confirm_delete_employee') }}')">
                                    {{ __('words.delete') }}
                                </button>
                            </form>
                            @else
                            @endif
                        </td>

                    </tr>
                    @endforeach
                </tbody>

            </table>
            <div class="mt-3 d-flex justify-content-center">
                {{ $admin_holidays->links() }}
            </div>
        </div>
    </div>
</div>

@endsection