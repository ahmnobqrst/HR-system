<style>
    .slide-menu {
        display: none;
        padding-left: 15px;
    }

    .slide.has-sub.open>.slide-menu {
        display: block;
    }
</style>
<aside class="app-sidebar sticky" id="sidebar">
    <!-- Start::main-sidebar-header -->
    <div class="main-sidebar-header">
        <a href="#" class="header-logo">
            <img src="{{ asset('images/brand-logos/logo.png')}}" alt="logo" class="desktop-logo" />
            <img src="{{ asset('images/brand-logos/toggle-logo.png')}}" alt="logo" class="toggle-logo" />
            <img src="{{ asset('images/brand-logos/desktop-dark.png')}}" alt="logo" class="desktop-dark" />
            <img src="{{ asset('images/brand-logos/toggle-dark.png')}}" alt="logo" class="toggle-dark" />
        </a>
    </div>
    <!-- End::main-sidebar-header -->

    <!-- Start::main-sidebar -->
    <div class="main-sidebar" id="sidebar-scroll">
        <nav class="main-menu-container nav nav-pills flex-column sub-open">
            <div class="slide-left" id="slide-left">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path>
                </svg>
            </div>
            <ul class="main-menu">

                <!--employees -->
                <li class="slide has-sub">
                    <a href="javascript:void(0);" class="side-menu__item text-capitalize">
                        <i class="las la-chalkboard-teacher side-menu__icon"></i>
                        <span class="side-menu__label text-capitalize">{{ trans('words.employees') }}</span>
                        <i class="fe fe-chevron-right side-menu__angle"></i>
                    </a>

                    <ul class="slide-menu child1">
                        <li class="slide">
                            <a href="{{route('get.department.employees')}}" class="side-menu__item text-capitalize">
                                <i class="bx bx-user-plus side-menu__icon"></i> {{ trans('words.all_employees') }}
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- departments -->
                <li class="slide has-sub">
                    <a href="javascript:void(0);" class="side-menu__item text-capitalize">
                        <i class="las la-chalkboard-teacher side-menu__icon"></i>
                        <span class="side-menu__label text-capitalize">{{ trans('words.departments') }}</span>
                        <i class="fe fe-chevron-right side-menu__angle"></i>
                    </a>

                    <ul class="slide-menu child1">
                        <li class="slide">
                            <a href="{{route('get.admin.department')}}" class="side-menu__item text-capitalize">
                                <i class="bx bx-group side-menu__icon"></i>{{ trans('words.all_departments') }}
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Sub Categories -->
                <li class="slide has-sub">
                    <a href="javascript:void(0);" class="side-menu__item text-capitalize">
                        <i class="las la-chalkboard-teacher side-menu__icon"></i>
                        <span class="side-menu__label text-capitalize">{{ trans('words.attendance') }}</span>
                        <i class="fe fe-chevron-right side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        <li class="slide">
                            <a href="{{ route('admin.attendance.report') }}" class="side-menu__item text-capitalize">
                                <i class="bx bx-group side-menu__icon"></i> {{ trans('words.attendance_report') }}
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Senders -->
                <li class="slide has-sub">
                    <a href="javascript:void(0);" class="side-menu__item text-capitalize">
                        <i class="las la-chalkboard-teacher side-menu__icon"></i>
                        <span class="side-menu__label text-capitalize">{{ trans('words.leaves') }}</span>
                        <i class="fe fe-chevron-right side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        <li class="slide">
                            <a href="{{route('admin.all.leaves')}}" class="side-menu__item text-capitalize">
                                <i class="bx bx-group side-menu__icon"></i>{{ trans('words.all_leaves') }}
                            </a>
                        </li>
                        <li class="slide">
                            <a href="{{route('admin.admin.leaves')}}" class="side-menu__item text-capitalize">
                                <i class="bx bx-group side-menu__icon"></i>{{ trans('words.admin_leaves') }}
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="slide has-sub">
                    <a href="javascript:void(0);" class="side-menu__item text-capitalize">
                        <i class="las la-user-shield side-menu__icon"></i>
                        <span class="side-menu__label text-capitalize">{{ trans('words.Holidays') }}</span>
                        <i class="fe fe-chevron-right side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        <li class="slide">
                            <a href="{{ route('holidays.index') }}" class="side-menu__item text-capitalize">
                                <i class="bx bx-user-plus side-menu__icon"></i>{{ trans('words.Holidays') }}
                            </a>
                            <a href="{{ route('get.admin.holidays') }}" class="side-menu__item text-capitalize">
                                <i class="bx bx-user-plus side-menu__icon"></i>{{ trans('words.admin_holidays') }}
                            </a>
                            <a href="{{route('get.offical.holidays')}}" class="side-menu__item text-capitalize">
                                <i class="bx bx-shield side-menu__icon"></i>{{ trans('words.offical-holidays') }}
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="slide has-sub">
                    <a href="javascript:void(0);" class="side-menu__item text-capitalize">
                        <i class="las la-user-shield side-menu__icon"></i>
                        <span class="side-menu__label text-capitalize">{{ trans('words.appearence') }}</span>
                        <i class="fe fe-chevron-right side-menu__angle"></i>
                    </a>
                    <ul class="slide-menu child1">
                        <li class="slide">
                            <a href="{{route('admin.attendance.register')}}" class="side-menu__item text-capitalize">
                                <i class="bx bx-user-plus side-menu__icon"></i>{{ trans('words.appearence_register') }}
                            </a>
                            <a href="{{route('admin.attendance.history')}}" class="side-menu__item text-capitalize">
                                <i class="bx bx-user-plus side-menu__icon"></i>{{ trans('words.appearence') }}
                            </a>
                        </li>
                    </ul>
                </li>



            </ul>

            <div class="slide-right" id="slide-right">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path>
                </svg>
            </div>

        </nav>
        <!-- End::nav -->
    </div>
    <!-- End::main-sidebar -->
</aside>
<script>
    document.querySelectorAll('.slide.has-sub > a').forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            const parent = this.parentElement;
            document.querySelectorAll('.slide.has-sub.open').forEach(el => {
                if (el !== parent) el.classList.remove('open');
            });
            parent.classList.toggle('open');
        });
    });
</script>