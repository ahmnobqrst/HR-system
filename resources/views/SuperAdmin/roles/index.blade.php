@extends('dashboard.includes.master')
@section('title', trans('words.roles'))

@section('content')
<div class="container-fluid">
    <div class="mb-3">
        <a href="{{ route('roles.create') }}" class="btn btn-primary">{{ trans('words.add_role') }}</a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>{{ trans('words.name') }}</th>
                <th>{{ trans('words.permissions') }}</th>
                <th>{{ trans('words.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($roles as $role)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $role->name }}</td>
                <td>
                    @foreach($role->permissions as $permission)
                        <span class="badge bg-info">{{ $permission->name }}</span>
                    @endforeach
                </td>
                <td>
                    <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-sm btn-warning">{{ trans('words.edit') }}</a>
                    <form action="{{ route('roles.destroy', $role->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">{{ trans('words.delete') }}</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
     <div class="mt-3 d-flex justify-content-center">
                {{ $roles->links() }}
            </div>
</div>
@endsection
