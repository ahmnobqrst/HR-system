@extends('dashboard.includes.master')
@section('title')
{{ __('words.departments') }}
@endsection
@push('css')
<style>
    .table thead th {
        background-color: #3b82f6;
        color: white;
        text-align: center;
    }
    .table tbody td {
        text-align: center;
    }
    .action-btn {
        margin: 0 2px;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="{{ route('create.department') }}" class="btn btn-primary">{{ __('words.add_department') }}</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>{{ __('words.name') }}</th>
                            <th>{{ __('words.description') }}</th>
                            <th>{{ __('words.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($departments as $department)
                            <tr>
                                <td>{{ $department->name }}</td>
                                <td>{{ $department->description }}</td>
                                <td>
                                    <a href="{{ route('get.department', $department->id) }}" class="btn btn-sm btn-warning action-btn">
                                        {{ __('words.edit') }}
                                    </a>
                                    <form action="{{ route('delete.department', $department->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$department->id}}"/>
                                        <button type="submit" class="btn btn-sm btn-danger action-btn" onclick="return confirm('{{ __('words.confirm_delete') }}')">
                                            {{ __('words.delete') }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">{{ __('words.no_departments') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-3 d-flex justify-content-center">
                {{ $departments->links() }}
            </div>

                
            </div>
        </div>
    </div>
</div>
@endsection
