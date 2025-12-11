@extends('dashboard.includes.master')
@section('title')
{{ __('words.employees_list') }}
@endsection
@push('css')
<style>
    .employee-card {
        border-radius: 12px;
        overflow: hidden;
        transition: 0.3s;
    }

    .employee-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 0 10px rgba(0, 0, 0, .12);
    }

    .employee-img {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #ddd;
    }

    .employee-table th {
        background: #e8edf3;
        white-space: nowrap;
    }

    .page-title {
        font-weight: 700;
        font-size: 26px;
    }

    .top-btn {
        border-radius: 7px;
    }
</style>
@endpush


@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <a class="btn btn-primary top-btn" href="{{route('get.create.employee')}}">
            {{ __('words.add_employee') }}
        </a>
    </div>


    <div class="card p-3 employee-card">

        <table class="table employee-table table-hover align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ __('words.name') }}</th>
                    <th>{{ __('words.email') }}</th>
                    <th>{{ __('words.phone') }}</th>
                    <th>{{ __('words.job_title') }}</th>
                    <th>{{ __('words.department') }}</th>
                    <th>{{ __('words.work_schedule') }}</th>
                    <th>{{ __('words.action') }}</th>
                </tr>
            </thead>

            <tbody>
                @foreach($employees as $employee)
                <tr>
                    <td>{{ $loop->iteration }}</td>


                    <td>{{ $employee->name }}</td>

                    <td>{{ $employee->email }}</td>

                    <td>{{ $employee->phone }}</td>

                    <td>{{ $employee->job_title }}</td>

                    <td>{{ optional($employee->department)->name }}</td>

                    <td>{{ optional($employee->workSchedule)->name }}</td>


                    <td>
                        <a class="btn btn-sm btn-info" href="{{route('show_employee_data',$employee->id)}}">
                            {{ __('words.show') }}
                        </a>

                        <a class="btn btn-sm btn-warning" href="{{route('edit_employee',$employee->id)}}">
                            {{ __('words.edit') }}
                        </a>


                        <form action="{{ route('delete.employee', $employee->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            <input type="hidden" name="id" value="{{$employee->id}}" />
                            <button type="submit" class="btn btn-sm btn-danger action-btn" onclick="return confirm('{{ __('words.confirm_delete_employee') }}')">
                                {{ __('words.delete') }}
                            </button>
                        </form>
                    </td>

                </tr>
                @endforeach

            </tbody>
        </table>
         <div class="mt-3 d-flex justify-content-center">
                {{ $employees->links() }}
            </div>

    </div>

</div>

@endsection