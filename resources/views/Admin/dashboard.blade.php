@extends('dashboard.includes.master')
@section('title')
{{ trans('words.Dashbord_admin') }}
@endsection
@push('css')
<style>

    body, html {
        margin: 0;
        padding: 0;
        font-family: 'Cairo', sans-serif;
    }

    .main-content, .page-header-breadcrumb {
        margin-top: 0 !important;
        padding-top: 0 !important;
    }

    .card.custom-card {
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card.custom-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }
</style>
@endpush


@section('content')


<div class="row g-3">

    <div class="col-xl-3 col-md-6">
        <div class="card custom-card card-bg-secondary text-center">
            <div class="card-body d-flex flex-column align-items-center justify-content-center">
                <div class="avatar mb-2"><i class="ri-money-dollar-circle-fill fs-28 text-white"></i></div>
                <div class="fs-15 fw-semibold">{{$department ? 1 : 0}}</div>
                <p class="mb-2">{{ trans('words.all_departent') }}</p>
                <a href="{{route('get.admin.department')}}" class="text-white text-decoration-underline mt-2">{{ trans('words.Show_Details') }}</a>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card custom-card card-bg-info text-center">
            <div class="card-body d-flex flex-column align-items-center justify-content-center">
                <div class="avatar mb-2"><i class="ri-team-fill fs-28 text-white"></i></div>
                <div class="fs-15 fw-semibold">{{$employees->count()}}</div>
                <p class="mb-2">{{ trans('words.Employees') }}</p>
                <a href="{{route('get.department.employees')}}" class="text-white text-decoration-underline mt-2">{{ trans('words.Show_Details') }}</a>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card custom-card card-bg-success text-center">
            <div class="card-body d-flex flex-column align-items-center justify-content-center">
                <div class="avatar mb-2"><i class="ri-user-follow-fill fs-28 text-white"></i></div>
                <div class="fs-15 fw-semibold">{{$attendences->count()}}</div>
                <p class="mb-2">{{ trans('words.Today_Present') }}</p>
                <a href="{{route('admin.present.employee')}}" class="text-white text-decoration-underline mt-2">{{ trans('words.Show_Details') }}</a>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card custom-card card-bg-danger text-center">
            <div class="card-body d-flex flex-column align-items-center justify-content-center">
                <div class="avatar mb-2"><i class="ri-user-unfollow-fill fs-28 text-white"></i></div>
                <div class="fs-15 fw-semibold">{{$absents->count()}}</div>
                <p class="mb-2">{{ trans('words.Today_Absent') }}</p>
                <a href="{{route('admin.absent.employees')}}" class="text-white text-decoration-underline mt-2">{{ trans('words.Show_Details') }}</a>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card custom-card card-bg-warning text-center">
            <div class="card-body d-flex flex-column align-items-center justify-content-center">
                <div class="avatar mb-2"><i class="ri-user-unfollow-fill fs-28 text-white"></i></div>
                <div class="fs-15 fw-semibold">{{$lates->count()}}</div>
                <p class="mb-2">{{ trans('words.Today_late') }}</p>
                <a href="{{route('admin.lats.employee')}}" class="text-white text-decoration-underline mt-2">{{ trans('words.Show_Details') }}</a>
            </div>
        </div>
    </div>

</div>





@endsection

@push('js')
@endpush
