@extends('dashboard.includes.master')

@section('title', trans('words.add_holidays'))

@section('content')
<div class="container-fluid">
    <div class="card mt-4">
        <div class="card-header bg-primary text-white">
            <h4>{{ __('words.add_holiday') }}</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('create.employee.holiday') }}">
                @csrf
                
                {{-- Leave Type Arabic --}}
                <div class="mb-3">
                    <label for="leave_type_ar" class="form-label">{{ __('words.leave_type_ar') }}</label>
                    <input type="text" class="form-control" name="leave_type_ar" id="leave_type_ar" value="{{ old('leave_type_ar') }}">
                    @error('leave_type_ar')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Leave Type English --}}
                <div class="mb-3">
                    <label for="leave_type_en" class="form-label">{{ __('words.leave_type_en') }}</label>
                    <input type="text" class="form-control" name="leave_type_en" id="leave_type_en" value="{{ old('leave_type_en') }}">
                    @error('leave_type_en')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Start Date --}}
                <div class="mb-3">
                    <label for="start_date" class="form-label">{{ __('words.start_date') }}</label>
                    <input type="date" class="form-control" name="start_date" id="start_date" value="{{ old('start_date') }}">
                    @error('start_date')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- End Date --}}
                <div class="mb-3">
                    <label for="end_date" class="form-label">{{ __('words.end_date') }}</label>
                    <input type="date" class="form-control" name="end_date" id="end_date" value="{{ old('end_date') }}">
                    @error('end_date')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Reason --}}
                <div class="mb-3">
                    <label for="reason" class="form-label">{{ __('words.reason') }}</label>
                    <textarea class="form-control" name="reason_ar" id="reason_ar" rows="3">{{ old('reason_ar') }}</textarea>
                    @error('reason_ar')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                {{-- Reason --}}
                <div class="mb-3">
                    <label for="reason" class="form-label">{{ __('words.reason_en') }}</label>
                    <textarea class="form-control" name="reason_en" id="reason_en" rows="3">{{ old('reason_en') }}</textarea>
                    @error('reason_en')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Status (hidden, default pending) --}}
                <input type="hidden" name="status" value="pending">

                {{-- Submit --}}
                <button type="submit" class="btn btn-success">{{ __('words.save') }}</button>
            </form>
        </div>
    </div>
</div>
@endsection
