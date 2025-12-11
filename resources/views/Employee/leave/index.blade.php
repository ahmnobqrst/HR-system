@extends('dashboard.includes.master')

@section('title', trans('words.All_leaves'))

@section('content')

<div class="card">
    <div class="card-header">
        <a class="btn btn-primary top-btn" href="{{route('employee.form.leave')}}">
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
                        <th>{{ trans('words.action') }}</th>
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
                            @if($leave->status == 'pendding')
                            <span class="btn btn-sm btn-warning">{{$leave->status}}</span>
                            @elseif($leave->status == 'accepted')
                            <span class="btn btn-sm btn-success">{{$leave->status}}</span>
                            @else
                            <span class="btn btn-sm btn-danger">{{$leave->status}}</span>
                            @endif
                        </td>
                        <td>{{ $leave->created_at->format('Y-m-d') }}</td>

                        <td>
                            @if($leave->status == 'pendding')
                            <a href="{{route('employee.edit.leave',$leave->id)}}"
                                class="btn btn-info btn-sm" role="button" aria-pressed="true"><i
                                    class="fa fa-edit"></i></a>
                            <button type="button" class="btn btn-danger btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#delete_leave{{ $leave->id }}">
                                <i class="fa fa-trash"></i>
                            </button>
                            @else
                            @endif
                        </td>

                    </tr>
                    <!-- this is model for delete Leave-->
                    <div class="modal fade" id="delete_leave{{$leave->id}}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="{{route('delete.employee.leave','test')}}" method="post">
                                @csrf

                                <input type="hidden" name="id" value="{{$leave->id}}"/>

                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title">{{ trans('Students_trans.Delete_leave') }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">{{ trans('Students_trans.Close') }}</button>

                                        <button type="submit"
                                            class="btn btn-danger">{{ trans('Students_trans.Delete') }}</button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- End Delete Model -->
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