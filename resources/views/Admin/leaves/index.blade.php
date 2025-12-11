@extends('dashboard.includes.master')

@section('title', trans('words.All_leaves'))

@section('content')

<div class="card">
    <div class="card-header">
        <a class="btn btn-primary top-btn" href="{{route('get.form.leave')}}">
            {{ __('words.add_leave') }}
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
                        <th>{{ trans('words.Hours_Balance') }}</th>
                        <th>{{ trans('words.Year') }}</th>
                        <th>{{ trans('words.status') }}</th>
                        <th>{{ trans('words.Created_At') }}</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($leaves as $leave)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $leave->user?->name }}</td>

                        <td>{{ $leave->getTranslation('leave_type', app()->getLocale()) }}</td>

                        <td>{{ $leave->balance_hours }}</td>

                        <td>{{ $leave->year }}</td>
                        <td>
                            @if($leave->status == 'pendding' && $leave->user->hasRole('Employee'))
                            <form action="{{route('leave.approve',$leave->id)}}" method="POST" style="display:inline-block;">
                                @csrf
                                <button class="btn btn-success btn-sm">{{ __('words.Approve') }}</button>
                            </form>
                            <form action="{{route('leave.reject',$leave->id)}}" method="POST" style="display:inline-block;">
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
                            <form action="{{ route('delete.employee.leave', $leave->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                <input type="hidden" name="id" value="{{$leave->id}}" />
                                <button type="submit" class="btn btn-sm btn-danger action-btn" onclick="return confirm('{{ __('words.holiday_deleted') }}')">
                                    {{ __('words.delete') }}
                                </button>
                            </form>
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