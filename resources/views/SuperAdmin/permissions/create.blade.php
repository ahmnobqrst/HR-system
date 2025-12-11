@extends('dashboard.includes.master')
@section('title', trans('words.add_permission'))

@section('content')
<div class="container-fluid">
    <div class="card p-4">
        <h4 class="mb-3">{{ trans('words.add_permission') }}</h4>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('permissions.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>{{ trans('words.name') }}</label>
                <input type="text" name="name" class="form-control" placeholder="{{ trans('words.name') }}" required>
            </div>

            <button type="submit" class="btn btn-success">{{ trans('words.save') }}</button>
            <a href="{{ route('permissions.index') }}" class="btn btn-secondary">{{ trans('words.cancel') }}</a>
        </form>
    </div>
</div>
@endsection
