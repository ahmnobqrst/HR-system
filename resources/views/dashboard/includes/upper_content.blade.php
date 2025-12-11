<div class="main-content app-content">
    <div class="container-fluid">
        <!-- Start::page-header -->

        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <div>
                <h1 class="page-title fw-semibold fs-18 mb-0 text-capitalize">
                   @yield('title')
                </h1>
            </div>

            <div class="ms-md-1 ms-0">
                <nav>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item text-capitalize">
                            @if(auth()->user()->hasRole('SuperAdmin'))
                            <a href="{{route('superadmin.dashboard')}}">Dashboard</a>
                            @elseif(auth()->user()->hasRole('Admin'))
                            <a href="{{route('admin.dashboard')}}">Dashboard</a>
                            @else
                            <a href="{{route('employee.dashboard')}}">Dashboard</a>
                            @endif
                        </li>

                        <li class="breadcrumb-item text-capitalize active" aria-current="page">
                            home
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- End::page-header -->

        <div class="detections-page">
            <div class="row">

