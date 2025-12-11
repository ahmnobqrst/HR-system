@extends('dashboard.includes.transfer')
@section('css')

@endsection
@section('title')
تسجيل مستخدم جديد
@endsection

@section('content')
<!-- End Switcher -->
<div class="row authentication mx-0">

    <div class="col-xxl-7 col-xl-7 col-lg-12">
        <div class="row justify-content-center align-items-center h-90">
            <div class="col-xxl-6 col-xl-7 col-lg-7 col-md-7 col-sm-8 col-12">
                <div class="p-5">

                    <p class="h5 fw-semibold mb-2">Sign Up</p>
                    <p class="mb-3 text-muted op-7 fw-normal">Welcome back Myfreiend !</p></br></br>
                    </br>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="input-group">
                            <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror"
                                name="password" required autocomplete="new-password">
                            <button class="btn btn-light" type="button" onclick="createpassword('password', this)">
                                <i class="ri-eye-off-line align-middle"></i>
                            </button>
                        </div>
                        @error('password')
                        <span class="text-danger fs-12">{{ $message }}</span>
                        @enderror

                        <div class="input-group">
                            <input id="password-confirm" type="password" class="form-control form-control-lg"
                                name="password_confirmation" required autocomplete="new-password">
                            <button class="btn btn-light" type="button" onclick="createpassword('password-confirm', this)">
                                <i class="ri-eye-off-line align-middle"></i>
                            </button>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxl-5 col-xl-5 col-lg-5 d-xl-block d-none px-0">
        <div class="authentication-cover">
            <div class="aunthentication-cover-content rounded">
                <div class="swiper keyboard-control">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="text-fixed-white text-center p-3 d-flex align-items-center justify-content-center">
                                <div>
                                    <div class="mb-5">
                                        <img src="{{ asset('assets/images/authentication/coumputer.jpeg')}}" class="authentication-image" alt="">
                                    </div>
                                    <h6 class="fw-semibold">Sign Up</h6>
                                    <p class="fw-normal fs-14 op-7"> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa eligendi expedita aliquam quaerat nulla voluptas facilis. Porro rem voluptates possimus, ad, autem quae culpa architecto, quam labore blanditiis at ratione.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@section('js')

<script>
    let createpassword = (type, ele) => {
        document.getElementById(type).type = document.getElementById(type).type == "password" ? "text" : "password"
        let icon = ele.childNodes[0].classList
        let stringIcon = icon.toString()
        if (stringIcon.includes("ri-eye-line")) {
            ele.childNodes[0].classList.remove("ri-eye-line")
            ele.childNodes[0].classList.add("ri-eye-off-line")
        } else {
            ele.childNodes[0].classList.add("ri-eye-line")
            ele.childNodes[0].classList.remove("ri-eye-off-line")
        }
    }
</script>

@endsection