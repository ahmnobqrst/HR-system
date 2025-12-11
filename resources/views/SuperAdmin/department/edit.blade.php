@extends('dashboard.includes.master')
@section('title')
{{ __('words.edit_department') }}
@endsection
@push('css')
<style>
    .form-card {
        max-width: 600px;
        margin: 20px auto;
        padding: 25px;
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    }

    .form-card h2 {
        margin-bottom: 20px;
        font-weight: 600;
        color: #1e293b;
    }

    .form-card label {
        font-weight: 500;
        color: #334155;
    }

    .form-card input,
    .form-card textarea {
        border-radius: 8px;
        border: 1px solid #cbd5e1;
        padding: 8px 12px;
        width: 100%;
        margin-bottom: 15px;
    }

    .form-card button {
        border-radius: 8px;
        padding: 8px 20px;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="form-card">

        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('update.department', $department->id) }}">
            @csrf

            <div class="mb-3">
                <label for="name_ar">{{ __('words.name_ar') }}</label>
                <input type="text" name="name_ar" id="name_ar" class="form-control"
                    value="{{ $department->getTranslation('name','ar') }}">
            </div>
            @error('name_ar')
            <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
            @enderror

            <div class="mb-3">
                <label for="name_en">{{ __('words.name_en') }}</label>
                <input type="text" name="name_en" id="name_en" class="form-control"
                    value="{{ $department->getTranslation('name','en') }}">
            </div>
            @error('name_en')
            <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
            @enderror

            <div class="mb-3">
                <label for="description_ar">{{ __('words.description_ar') }}</label>
                <textarea name="description_ar" id="description_ar" class="form-control" rows="4">{{ $department->getTranslation('description','ar') }}</textarea>
            </div>
            @error('description_ar')
            <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
            @enderror

            <div class="mb-3">
                <label for="description_en">{{ __('words.description_en') }}</label>
                <textarea name="description_en" id="description_en" class="form-control" rows="4">{{ $department->getTranslation('description','en') }}</textarea>
            </div>
            @error('description_ar')
            <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
            @enderror

            <div class="mb-3">
                <label for="user_id">{{ __('words.user_id') }}</label>

                <select name="user_id" id="user_id" class="form-control">
                    <option value="{{$department->user_id}}">
                        {{ optional($department->user)->name }}
                    </option>

                    @foreach($admins as $admin)
                    <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                    @endforeach
                </select>
            </div>

            @error('user_id')
            <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
            @enderror

            <button type="submit" class="btn btn-primary">{{ __('words.update') }}</button>
        </form>
    </div>
</div>
@endsection