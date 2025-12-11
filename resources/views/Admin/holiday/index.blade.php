@extends('dashboard.includes.master')

@section('title', trans('words.All_Employee_holidays'))

@section('content')
<div class="card">
    <div class="card-header">
        <a class="btn btn-primary" href="{{ route('holidays.create') }}">
            {{ __('words.add_holidays') }}
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ __('words.Employee_Name') }}</th>
                        <th>{{ __('words.Leave_Type') }}</th>
                        <th>{{ __('words.start_date') }}</th>
                        <th>{{ __('words.end_date') }}</th>
                        <th>{{ __('words.reason') }}</th>
                        <th>{{ __('words.status') }}</th>
                        <th>{{ __('words.Created_At') }}</th>
                        <th>{{ __('words.action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($leaves as $leave)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $leave->user?->name }}</td>
                        <td>{{ $leave->getTranslation('leave_type', app()->getLocale()) }}</td>
                        <td>{{ \Carbon\Carbon::parse($leave->start_date)->format('Y-m-d')  }}</td>
                        <td>{{ \Carbon\Carbon::parse($leave->end_date)->format('Y-m-d') }}</td>
                        <td>{{ $leave->getTranslation('reason', app()->getLocale()) ?? '-' }}</td>
                        <td>
                            @if($leave->status == 'pendding' && auth()->user()->hasRole('Admin'))
                            <form action="{{route('holiday.employee.approve',$leave->id)}}" method="POST" style="display:inline-block;">
                                @csrf
                                <button class="btn btn-success btn-sm">{{ __('words.Approve') }}</button>
                            </form>
                            <form action="{{route('holiday.employee.reject',$leave->id)}}" method="POST" style="display:inline-block;">
                                @csrf
                                <button class="btn btn-danger btn-sm">{{ __('words.Reject') }}</button>
                            </form>
                            @else
                            @if($leave->status == 'accepted')
                            <span class="badge bg-success">{{ __('words.accepted') }}</span>
                            @elseif($leave->status == 'rejected')
                            <span class="badge bg-danger">{{ __('words.rejected') }}</span>
                            @else
                            <span class="badge bg-warning">{{ __('words.pending') }}</span>
                            @endif
                            @endif
                        </td>
                        <td>{{ $leave->created_at->format('Y-m-d') }}</td>
                        <td>
                            @if($leave->status == 'pendding' && auth()->user()->hasRole('Employee'))
                            <a class="btn btn-sm btn-warning" href="{{route('holidays.edit',$leave->id)}}">
                                {{ __('words.edit') }}
                            </a>
                            <form action="{{ route('holidays.destroy', $leave->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="id" value="{{$leave->id}}" />
                                <button type="submit" class="btn btn-sm btn-danger action-btn" onclick="return confirm('{{ __('words.holiday_deleted') }}')">
                                    {{ __('words.delete') }}
                                </button>
                            </form>
                            @elseif($leave->status == 'pendding' && auth()->user()->hasRole('Admin'))
                            <form action="{{ route('holidays.destroy', $leave->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="id" value="{{$leave->id}}" />
                                <button type="submit" class="btn btn-sm btn-danger action-btn" onclick="return confirm('{{ __('words.holiday_deleted') }}')">
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
                {{ $leaves->links() }}
            </div>
        </div>
    </div>
</div>
@endsection