@extends('dashboard.includes.master')
@section('title', trans('words.permissions'))

@section('content')
<div class="container-fluid">
    <div class="mb-3">
        <a href="{{ route('permissions.create') }}" class="btn btn-primary">{{ trans('words.add_permission') }}</a>
    </div>

    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th>#</th>
                <th>{{ trans('words.name') }}</th>
                <th>{{ trans('words.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($permissions as $permission)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $permission->name }}</td>
                <td>
                    <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-sm btn-warning">{{ trans('words.edit') }}</a>
                    <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST" class="d-inline">
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
                {{ $permissions->links() }}
            </div>
</div>
@endsection
