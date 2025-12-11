@extends('dashboard.includes.master')

@section('title', trans('words.All_holidays_of_employee'))

@section('content')
<div class="card">
    <div class="card-header">
        <a class="btn btn-primary" href="{{ route('get.employee.creation.form') }}">
            {{ __('words.add_holidays') }}
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>#</th>
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
                        <td>{{ $leave->getTranslation('leave_type', app()->getLocale()) }}</td>
                        <td>{{ \Carbon\Carbon::parse($leave->start_date)->format('Y-m-d')  }}</td>
                        <td>{{ \Carbon\Carbon::parse($leave->end_date)->format('Y-m-d') }}</td>
                        <td>{{ $leave->getTranslation('reason', app()->getLocale()) ?? '-' }}</td>
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
                            <a href="{{route('edit.employee.holiday',$leave->id)}}"
                                class="btn btn-info btn-sm" role="button" aria-pressed="true"><i
                                    class="fa fa-edit"></i></a>
                            <button type="button" class="btn btn-danger btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#delete_holiday{{ $leave->id }}">
                                <i class="fa fa-trash"></i>
                            </button>


                            <!-- this is model for delete Leave-->
                            <div class="modal fade" id="delete_holiday{{$leave->id}}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form action="{{route('delete.employee.holiday','test')}}" method="post">
                                        @csrf

                                        <input type="hidden" name="id" value="{{$leave->id}}" />

                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h5 class="modal-title">{{ trans('Students_trans.Delete_holiday') }}</h5>
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