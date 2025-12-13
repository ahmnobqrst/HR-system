@extends('dashboard.includes.master')
@section('title')
{{ __('words.edit_employee') }}
@endsection
@push('css')
<style>
    .form-card {
        max-width: 900px;
        margin: 25px auto;
        padding: 35px;
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, .08);
    }

    .form-card h2 {
        font-weight: 700;
        margin-bottom: 30px;
    }

    label {
        font-weight: 600;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="form-card">

        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" enctype="multipart/form-data" action="{{ route('update.employee', $employee->id) }}">
            @csrf
            <div class="row">

                {{-- Name Arabic --}}
                <div class="col-md-6 mb-3">
                    <label>{{ __('words.name_ar') }}</label>
                    <input type="text" name="name_ar" class="form-control" value="{{ $employee->getTranslation('name','ar') }}">
                </div>
                @error('name_ar')
                <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                @enderror

                {{-- Name English --}}
                <div class="col-md-6 mb-3">
                    <label>{{ __('words.name_en') }}</label>
                    <input type="text" name="name_en" class="form-control" value="{{ $employee->getTranslation('name','en') }}">
                </div>
                @error('name_en')
                <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                @enderror

                {{-- Email --}}
                <div class="col-md-6 mb-3">
                    <label>{{ __('words.email') }}</label>
                    <input type="email" name="email" class="form-control" value="{{ $employee->email }}" readonly>
                </div>
                @error('email')
                <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                @enderror

                {{-- Password --}}
                <div class="col-md-6 mb-3">
                    <label>{{ __('words.password') }}</label>
                    <input type="password" name="password" class="form-control" id="password">
                    <div class="form-check mt-2">
                        <input type="checkbox" class="form-check-input" onclick="togglePassword()" id="showPassword">
                        <label class="form-check-label" for="showPassword">
                            {{ __('words.show_password') }}
                        </label>
                    </div>
                </div>
                @error('password')
                <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                @enderror

                {{-- Employee Number --}}
                <div class="col-md-6 mb-3">
                    <label>{{ __('words.employee_number') }}</label>
                    <input type="text" name="employee_number" class="form-control" value="{{ $employee->employee_number }}">
                </div>

                {{-- Address Arabic --}}
                <div class="col-md-6 mb-3">
                    <label>{{ __('words.address_ar') }}</label>
                    <input type="text" name="address_ar" class="form-control" value="{{ $employee->getTranslation('address','ar') }}">
                </div>
                @error('address_ar')
                <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                @enderror

                {{-- Address English --}}
                <div class="col-md-6 mb-3">
                    <label>{{ __('words.address_en') }}</label>
                    <input type="text" name="address_en" class="form-control" value="{{ $employee->getTranslation('address','en') }}">
                </div>
                @error('address_en')
                <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                @enderror

                {{-- Phone --}}
                <div class="col-md-6 mb-3">
                    <label>{{ __('words.phone') }}</label>
                    <input type="text" name="phone" class="form-control" value="{{ $employee->phone }}">
                </div>
                @error('phone')
                <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                @enderror

                {{-- Age --}}
                <div class="col-md-6 mb-3">
                    <label>{{ __('words.age') }}</label>
                    <input type="number" name="age" class="form-control" value="{{ $employee->age }}">
                </div>
                @error('age')
                <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                @enderror

                {{-- Gender --}}
                <div class="col-md-6 mb-3">
                    <label>{{ __('words.gender') }}</label>
                    <select class="form-control" name="gender">
                        <option value="{{ \App\Enum\GenderEnum::Male->value }}"
                            {{ $employee->gender == \App\Enum\GenderEnum::Male->value ? 'selected' : '' }}>
                            {{ __('words.male') }}
                        </option>

                        <option value="{{ \App\Enum\GenderEnum::Female->value }}"
                            {{ $employee->gender == \App\Enum\GenderEnum::Female->value ? 'selected' : '' }}>
                            {{ __('words.female') }}
                        </option>
                    </select>
                </div>
                @error('gender')
                <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                @enderror

                {{-- Job Title Arabic --}}
                <div class="col-md-6 mb-3">
                    <label>{{ __('words.job_title_ar') }}</label>
                    <input name="job_title_ar" class="form-control" value="{{ $employee->getTranslation('job_title','ar') }}">
                </div>
                @error('job_title_ar')
                <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                @enderror

                {{-- Job Title English --}}
                <div class="col-md-6 mb-3">
                    <label>{{ __('words.job_title_en') }}</label>
                    <input name="job_title_en" class="form-control" value="{{ $employee->getTranslation('job_title','en') }}">
                </div>
                @error('job_title_en')
                <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                @enderror

                {{-- Birthdate --}}
                <div class="col-md-6 mb-3">
                    <label>{{ __('words.birthdate') }}</label>
                    <input type="date" name="birthdate" class="form-control" value="{{ $employee->birthdate }}">
                </div>
                @error('birthdate')
                <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                @enderror

                {{-- Salary --}}
                <div class="col-md-6 mb-3">
                    <label>{{ __('words.salary') }}</label>
                    <input type="date" name="salary" class="form-control" value="{{ $employee->salary }}">
                </div>
                @error('salary')
                <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                @enderror

                {{-- Department --}}
                <div class="col-md-6 mb-3">
                    <label>{{ __('words.department') }}</label>
                    <select name="department_id" class="form-control">
                        @foreach($departments as $dept)
                        <option value="{{ $dept->id }}" {{ $employee->department_id == $dept->id ? 'selected' : '' }}>
                            {{ $dept->getTranslation('name', app()->getLocale()) }}
                        </option>
                        @endforeach
                    </select>
                </div>
                @error('department_id')
                <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                @enderror

                {{-- Work Schedule --}}
                <div class="col-md-6 mb-3">
                    <label>{{ __('words.work_schedule') }}</label>
                    <select name="work_schedule_id" class="form-control">
                        @foreach($work_schedules as $schedule)
                        <option value="{{ $schedule->id }}" {{ $employee->work_schedule_id == $schedule->id ? 'selected' : '' }}>
                            {{ $schedule->getTranslation('name', app()->getLocale()) }}
                        </option>
                        @endforeach
                    </select>
                </div>
                @error('work_schedule_id')
                <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                @enderror

                {{-- Image --}}
                <div class="col-md-6 mb-3">
                    <label>{{ __('words.image') }}</label>
                    <input type="file" name="image" class="form-control">
                    @if($employee->image)
                    <img src="{{ asset('storage/'.$employee->image) }}" alt="employee image" class="mt-2" style="height:80px;">
                    @endif
                </div>
                @error('image')
                <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                @enderror

            </div>

            <button class="btn btn-primary">{{ __('words.update') }}</button>
        </form>
    </div>
</div>
@endsection

@section('js')
<script>
    function togglePassword() {
        const x = document.getElementById("password");
        x.type = x.type === "password" ? "text" : "password";
    }
</script>
@endsection