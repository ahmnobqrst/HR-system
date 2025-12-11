@include('dashboard.includes.head')


<!-- Start Switcher -->
@include('dashboard.includes.switch')
<!-- End Switcher -->

    <!-- app-header -->
@include('dashboard.includes.header')

    <!-- /app-header -->

    <!-- Start::app-sidebar -->
@include('dashboard.includes.sidebar')
    <!-- End::app-sidebar -->

    <!-- Start::app-content -->
@include('dashboard.includes.upper_content')


@yield('content')


@include('dashboard.includes.footer')



<!-- Popper JS -->
@include('dashboard.includes.foot')
