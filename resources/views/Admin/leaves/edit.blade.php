@extends('dashboard.includes.master')

@section('title', trans('words.edit_leave'))

@section('content')

<div class="row">
    <div class="col-md-8 offset-md-2">

        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4>{{ trans('words.edit_leave') }}</h4>
            </div>

            <form action="{{ route('update.admin.leave', $leave->id) }}" method="POST">
                @csrf

                <div class="card-body">

                    {{-- Arabic Leave Type --}}
                    <div class="form-group mb-3">
                        <label>{{ trans('words.Leave_Type') }} (AR)</label>
                        <input type="text" name="leave_type_ar" class="form-control" 
                               value="{{ old('leave_type_ar', $leave->getTranslation('leave_type','ar')) }}">
                        @error('leave_type_ar')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- English Leave Type --}}
                    <div class="form-group mb-3">
                        <label>{{ trans('words.Leave_Type') }} (EN)</label>
                        <input type="text" name="leave_type_en" class="form-control" 
                               value="{{ old('leave_type_en', $leave->getTranslation('leave_type','en')) }}">
                        @error('leave_type_en')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Hours Balance --}}
                    <div class="form-group mb-3">
                        <label>{{ trans('words.Hours_Balance') }}</label>
                        <input type="number" name="balance_hours" class="form-control" 
                               value="{{ old('balance_hours', $leave->balance_hours) }}">
                        @error('balance_hours')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Year --}}
                    <div class="form-group mb-3">
                        <label>{{ trans('words.Year') }}</label>
                        <input type="number" name="year" class="form-control" 
                               value="{{ old('year', $leave->year) }}">
                        @error('year')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </div>

                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-success">{{ trans('words.update') }}</button>
                    <a href="{{ route('admin.all.leaves') }}" class="btn btn-secondary">{{ trans('words.cancel') }}</a>
                </div>

            </form>

        </div>

    </div>
</div>

@endsection
