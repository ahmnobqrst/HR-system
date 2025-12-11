@extends('dashboard.includes.master')

@section('title', trans('words.edit_holiday'))

@section('content')
<div class="container-fluid">
    <div class="card mt-4">
        <div class="card-body">
            <form method="POST" action="{{ route('update.employee.holiday', $holiday->id) }}">
                @csrf
                {{-- Leave Type Arabic --}}
                <div class="mb-3">
                    <label for="leave_type_ar" class="form-label">{{ __('words.leave_type_ar') }}</label>
                    <input type="text" class="form-control" name="leave_type_ar" id="leave_type_ar" 
                           value="{{ $holiday->getTranslation('leave_type','ar') }}">
                    @error('leave_type_ar')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Leave Type English --}}
                <div class="mb-3">
                    <label for="leave_type_en" class="form-label">{{ __('words.leave_type_en') }}</label>
                    <input type="text" class="form-control" name="leave_type_en" id="leave_type_en" 
                           value="{{ $holiday->getTranslation('leave_type','en') }}">
                    @error('leave_type_en')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Start Date --}}
                <div class="mb-3">
                    <label for="start_date" class="form-label">{{ __('words.start_date') }}</label>
                    <input type="date" class="form-control" name="start_date" id="start_date" 
                           value="{{ \Carbon\Carbon::parse($holiday->start_date)->format('Y-m-d') }}">
                    @error('start_date')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- End Date --}}
                <div class="mb-3">
                    <label for="end_date" class="form-label">{{ __('words.end_date') }}</label>
                    <input type="date" class="form-control" name="end_date" id="end_date" 
                          value="{{ \Carbon\Carbon::parse($holiday->end_date)->format('Y-m-d') }}">
                    @error('end_date')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Reason Arabic --}}
                <div class="mb-3">
                    <label for="reason_ar" class="form-label">{{ __('words.reason') }}</label>
                    <textarea class="form-control" name="reason_ar" id="reason_ar" rows="3">{{ $holiday->getTranslation('reason','ar') }}</textarea>
                    @error('reason_ar')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Reason English --}}
                <div class="mb-3">
                    <label for="reason_en" class="form-label">{{ __('words.reason_en') }}</label>
                    <textarea class="form-control" name="reason_en" id="reason_en" rows="3">{{ $holiday->getTranslation('reason','en') }}</textarea>
                    @error('reason_en')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                

                {{-- Submit --}}
                <button type="submit" class="btn btn-success">{{ __('words.update') }}</button>
            </form>
        </div>
    </div>
</div>
@endsection
