@extends('dashboard.includes.master')
@section('title')
{{ __('words.add_employee') }}
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

        <form method="POST" enctype="multipart/form-data" action="{{ route('add.employee') }}">
            @csrf
            <div class="row">

                {{-- name --}}
                <div class="col-md-6 mb-3">
                    <label>{{ __('words.name') }}</label>
                    <input type="text" name="name_ar" class="form-control">
                </div>
                @error('name_ar')
                <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                @enderror

                {{-- Name English --}}
                <div class="col-md-6 mb-3">
                    <label>{{ __('words.name_en') }}</label>
                    <input type="text" name="name_en" class="form-control">
                </div>
                @error('name_en')
                <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                @enderror

                {{-- email --}}
                <div class="col-md-6 mb-3">
                    <label>{{ __('words.email') }}</label>
                    <input type="email" name="email" class="form-control">
                </div>
                @error('email')
                <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                @enderror

                {{-- password --}}
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

                {{-- employee number --}}
                <div class="col-md-6 mb-3">
                    <label>{{ __('words.employee_number') }}</label>
                    <input type="text" name="employee_number" class="form-control">
                </div>

                {{-- address --}}
                <div class="col-md-6 mb-3">
                    <label>{{ __('words.address') }}</label>
                    <input type="text" name="address_ar" class="form-control">
                </div>
                @error('address_ar')
                <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                @enderror

                {{-- address in English --}}
                <div class="col-md-6 mb-3">
                    <label>{{ __('words.address_en') }}</label>
                    <input name="address_en" class="form-control">
                </div>
                @error('address_en')
                <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                @enderror



                {{-- phone --}}
                <div class="col-md-6 mb-3">
                    <label>{{ __('words.phone') }}</label>
                    <input type="text" name="phone" class="form-control">
                </div>
                @error('phone')
                <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                @enderror

                {{-- age --}}
                <div class="col-md-6 mb-3">
                    <label>{{ __('words.age') }}</label>
                    <input type="number" name="age" class="form-control">
                </div>
                @error('age')
                <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                @enderror

                {{-- gender --}}
                <div class="col-md-6 mb-3">
                    <label>{{ __('words.gender') }}</label>
                    <select class="form-control" name="gender">
                        <option value="{{ \App\Enum\GenderEnum::Male->value }}">{{ __('words.male') }}</option>
                        <option value="{{ \App\Enum\GenderEnum::Female->value }}">{{ __('words.female') }}</option>
                    </select>
                </div>
                @error('gender')
                <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                @enderror

                {{-- job title in Arabic --}}
                <div class="col-md-6 mb-3">
                    <label>{{ __('words.job_title_ar') }}</label>
                    <input name="job_title_ar" class="form-control">
                </div>
                @error('job_title_ar')
                <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                @enderror

                {{-- job title in English --}}
                <div class="col-md-6 mb-3">
                    <label>{{ __('words.job_title_en') }}</label>
                    <input name="job_title_en" class="form-control">
                </div>
                @error('job_title_en')
                <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                @enderror

                {{-- birthdate --}}
                <div class="col-md-6 mb-3">
                    <label>{{ __('words.birthdate') }}</label>
                    <input type="date" name="birthdate" class="form-control">
                </div>
                @error('birthdate')
                <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                @enderror

                {{-- department --}}
                <div class="col-md-6 mb-3">
                    <label>{{ __('words.department') }}</label>
                    <select name="department_id" class="form-control">
                        <option value="">{{ __('words.select_department') }}</option>
                        @foreach($departments as $dept)
                        <option value="{{ $dept->id }}">
                            {{ $dept->getTranslation('name', app()->getLocale()) }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3 mt-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1" id="is_manager" name="is_manager">
                        <label class="form-check-label" for="is_manager">
                            {{ __('words.make_manager') }}
                        </label>
                    </div>
                </div>
                @error('department_id')
                <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                @enderror





                {{-- work schedule --}}
                <div class="col-md-6 mb-3">
                    <label>{{ __('words.work_schedule') }}</label>
                    <select name="work_schedule_id" class="form-control">
                        @foreach($work_schedules as $schedule)
                        <option value="{{ $schedule->id }}">
                            {{ $schedule->getTranslation('name', app()->getLocale()) }}
                        </option>
                        @endforeach
                    </select>
                </div>
                @error('work_schedule_id')
                <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                @enderror


                {{-- Salary --}}
                <div class="col-md-6 mb-3">
                    <label>{{ __('words.salary') }}</label>
                    <input name="salary" class="form-control">
                </div>
                @error('salary')
                <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                @enderror

                {{-- image --}}
                <div class="col-md-6 mb-3">
                    <label>{{ __('words.image') }}</label>
                    <input type="file" name="image" class="form-control">
                </div>
                @error('image')
                <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
                @enderror

            </div>

            <button class="btn btn-primary">{{ __('words.save') }}</button>
        </form>
    </div>
</div>
@endsection

@section('js')
<script>
    // Show/Hide password
    function togglePassword() {
        const x = document.getElementById("password");
        x.type = x.type === "password" ? "text" : "password";
    }

    // Preview image when selected
    document.getElementById('profileImageInput').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(ev) {
                document.getElementById('profileImagePreview').src = ev.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection