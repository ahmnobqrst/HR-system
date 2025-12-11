@extends('dashboard.includes.master')
@section('title', __('words.settings'))

@section('content')
<div class="container-fluid">

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- General Settings --}}
        <div class="card mb-4 p-4">
            <h4>{{ __('words.general_settings') }}</h4>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label>{{ __('words.company_name_ar') }}</label>
                    <input type="text" name="company_name_ar" class="form-control" value="{{ $general['company_name']['ar'] ?? '' }}">
                </div>
                <div class="col-md-6">
                    <label>{{ __('words.company_name_en') }}</label>
                    <input type="text" name="company_name_en" class="form-control" value="{{ $general['company_name']['en'] ?? '' }}">
                </div>
                <div class="col-md-6 mt-3">
                    <label>{{ __('words.phone') }}</label>
                    <input type="text" name="phone" class="form-control" value="{{ $general['phone'] ?? '' }}">
                </div>
                <div class="mb-3">
                    <label>{{ __('words.logo') }}</label><br>
                    @if(!empty($general['logo_url']))
                    <img src="{{ $general['logo_url'] }}" alt="Company Logo" style="height: 80px; display:block; margin-bottom:10px;">
                    @endif
                    <input type="file" name="logo" class="form-control">
                    <small class="text-muted">رفع صورة جديدة سيقوم باستبدال الصورة الحالية</small>
                </div>
                <div class="col-md-6 mt-3">
                    <label>{{ __('words.email') }}</label>
                    <input type="email" name="email" class="form-control" value="{{ $general['email'] ?? '' }}">
                </div>
                <div class="col-md-6 mt-3">
                    <label>{{ __('words.address') }}</label>
                    <input type="text" name="address_ar" class="form-control" value="{{ $general['address']['ar'] ?? '' }}">
                </div>
                <div class="col-md-6 mt-3">
                    <label>{{ __('words.address_en') }}</label>
                    <input type="text" name="address_en" class="form-control" value="{{ $general['address']['en'] ?? '' }}">
                </div>
            </div>
        </div>

        {{-- Work Schedule --}}
        <div class="card mb-4 p-4">
            <h4>{{ __('words.work_schedule') }}</h4>

            <div class="row mb-3">
                <div class="col-md-3">
                    <label>{{ __('words.start_time') }}</label>
                    <input type="time" name="work_schedule[start_time]" class="form-control" value="{{ $work_schedule['start_time'] ?? '09:00' }}">
                </div>
                <div class="col-md-3">
                    <label>{{ __('words.end_time') }}</label>
                    <input type="time" name="work_schedule[end_time]" class="form-control" value="{{ $work_schedule['end_time'] ?? '17:00' }}">
                </div>
                <div class="col-md-3">
                    <label>{{ __('words.working_hours_per_day') }}</label>
                    <input type="number" name="work_schedule[working_hours_per_day]" class="form-control" value="{{ $work_schedule['working_hours_per_day'] ?? 8 }}">
                </div>
                <div class="col-md-3">
                    <label>{{ __('words.weekly_working_days') }}</label>
                    <select name="work_schedule[weekly_working_days][]" class="form-control" multiple>
                        @foreach(['Mon','Tue','Wed','Thu','Fri','Sat','Sun'] as $day)
                        <option value="{{ $day }}"
                            @if(in_array($day, $work_schedule['weekly_working_days'] ?? [])) selected @endif>
                            {{ $day }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        {{-- Holidays --}}
        <div class="card mb-4 p-4">
            <h4>{{ __('words.holidays') }}</h4>
            <small>{{ __('words.holidays_json_info') }}</small>
            <textarea name="holidays_json" class="form-control" rows="6">@json($holidays)</textarea>
        </div>

        <button type="submit" class="btn btn-primary">{{ __('words.save') }}</button>
    </form>
</div>
@endsection