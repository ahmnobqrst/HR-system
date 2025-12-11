@extends('dashboard.includes.master')
@section('title', trans('words.add_role'))

@section('content')
<div class="container-fluid">
    <div class="card p-4">
        <form action="{{ route('roles.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>{{ trans('words.name') }}</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>{{ trans('words.select_permissions') }}</label>
                <select name="permissions[]" class="form-control" multiple>
                    @foreach($permissions as $permission)
                        <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                    @endforeach
                </select>
            </div>

            <button class="btn btn-success">{{ trans('words.save') }}</button>
            <a href="{{ route('roles.index') }}" class="btn btn-secondary">{{ trans('words.cancel') }}</a>
        </form>
    </div>
</div>
@endsection
