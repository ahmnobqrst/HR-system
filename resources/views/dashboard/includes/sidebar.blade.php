<div class="container-fluid">
    <div class="row">

        @if(auth()->check() && auth()->user()->hasRole('SuperAdmin'))
        @include('dashboard.main-sidebar.superadminsidebar')
        @endif

        @if(auth()->check() && auth()->user()->hasRole('Admin'))
        @include('dashboard.main-sidebar.adminsidebar')
        @endif

        @if(auth()->check() && auth()->user()->hasRole('Employee'))
        @include('dashboard.main-sidebar.employeesidebar')
        @endif


    </div>
</div>
<!-- Left Sidebar End-->

<!--=================================