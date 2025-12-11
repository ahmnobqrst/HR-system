@extends('dashboard.includes.master')
@section('css')
@toastr_css
@section('title')
{{ trans('words.employee_details') }}
@stop
@endsection

@section('page-header')
@section('PageTitle')
{{ trans('words.employee_details') }}
@stop
@endsection

@section('content')


<div class="row">
    <div class="col-md-8 offset-md-2 mb-30">

        <div class="card card-statistics h-100">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title">{{ trans('words.employee_details') }}</h5>
            </div>

            <div class="card-body">

                <table class="table table-bordered table-striped">
                    <tbody>

                        <tr>
                            <th>{{ trans('words.name') }}</th>
                            <td>{{ $employee->name }}</td>
                        </tr>

                        <tr>
                            <th>{{ trans('words.email') }}</th>
                            <td>{{ $employee->email }}</td>
                        </tr>

                        <tr>
                            <th>{{ trans('words.employee_number') }}</th>
                            <td>{{ $employee->employee_number }}</td>
                        </tr>

                        <tr>
                            <th>{{ trans('words.phone') }}</th>
                            <td>{{ $employee->phone }}</td>
                        </tr>

                        <tr>
                            <th>{{ trans('words.address') }}</th>
                            <td>{{ $employee->address }}</td>
                        </tr>

                        <tr>
                            <th>{{ trans('words.age') }}</th>
                            <td>{{ $employee->age }}</td>
                        </tr>

                        <tr>
                            <th>{{ trans('words.gender') }}</th>
                            <td>{{ $employee->gender }}</td>
                        </tr>

                        <tr>
                            <th>{{ __('words.salary') }}</th>
                            <td>{{ $employee->salary }}</td>
                        </tr>

                        <tr>
                            <th>{{ trans('words.job_title') }}</th>
                            <td>{{ $employee->job_title }}</td>
                        </tr>

                        <tr>
                            <th>{{ trans('words.birthdate') }}</th>
                            <td>{{ $employee->birthdate }}</td>
                        </tr>

                        <tr>
                            <th>{{ trans('words.department') }}</th>
                            <td>{{ optional($employee->department)->name }}</td>
                        </tr>

                        <tr>
                            <th>{{ trans('words.work_schedule') }}</th>
                            <td>{{ optional($employee->workSchedule)->name }}</td>
                        </tr>
                        <tr>
                            <th>{{ trans('words.Employee_image') }}</th>
                            <td>
                                <img class="employee-img" style="width:50px;height:50px" 
                                    src="{{ $employee->image ? asset('storage/'.$employee->image) : asset('default.png') }}">
                            </td>
                        </tr>

                    </tbody>
                </table>

            </div>
        </div>

    </div>
</div>

@endsection

@section('js')
@toastr_js
@toastr_render
@endsection