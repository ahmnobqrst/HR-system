@extends('dashboard.includes.master')
@section('title')
{{ __('words.em_departments') }}
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
                        </tr>
                    </thead>
                    <tbody>
                        @if($department)
                            <tr>
                                <td>{{ $department->name }}</td>
                                <td>{{ $department->description }}</td>
                            </tr>
                        @else
                        
                            <tr>
                                <td colspan="3">{{ __('words.no_departments') }}</td>
                            </tr>
                        @endif
                       
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
