<div class="page">
    @php
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Route;
    @endphp

    <header class="app-header">
        <div class="main-header-container">

            <!-- Start::header-content-left -->
            <div class="header-content-left">

                <!-- Logo -->
                <div class="header-element">
                    <div class="horizontal-logo">
                        <a href="#" class="header-logo">
                            <img src="{{ asset('images/brand-logos/logo.png')}}" class="desktop-logo" alt="logo" />
                            <img src="{{ asset('images/brand-logos/toggle-logo.png')}}" class="toggle-logo" alt="logo" />
                            <img src="{{ asset('images/brand-logos/desktop-dark.png')}}" class="desktop-dark" alt="logo" />
                            <img src="{{ asset('images/brand-logos/toggle-dark.png')}}" class="toggle-dark" alt="logo" />
                        </a>
                    </div>
                </div>
                <!-- End::Logo -->

                <!-- Sidebar Toggle -->
                <div class="header-element">
                    <a aria-label="Hide Sidebar"
                        class="sidemenu-toggle header-link animated-arrow hor-toggle horizontal-navtoggle"
                        data-bs-toggle="sidebar"
                        href="javascript:void(0);"><span></span></a>
                </div>
                <!-- End::Sidebar Toggle -->

                <!-- Language Dropdown -->

                <!-- End::Language Dropdown -->

            </div>

            <!-- End::header-content-left -->


            <!-- Start::header-content-right -->
            <div class="header-content-right">

                <!-- Notifications -->
                <div class="header-element notifications-dropdown">

                    <div class="main-header-dropdown dropdown-menu dropdown-menu-end">
                        <div class="p-3 d-flex align-items-center justify-content-between">
                            <p class="mb-0 fs-17 fw-semibold">Notifications</p>
                            <span class="badge bg-secondary-transparent" id="notifiation-data">5 Unread</span>
                        </div>



                        <div class="dropdown-divider"></div>

                        <ul class="list-unstyled mb-0" id="header-notification-scroll">

                            <!-- Notification Item 1 -->
                            <li class="dropdown-item">
                                <div class="d-flex align-items-start">
                                    <div class="pe-2">
                                        <span class="avatar avatar-md bg-primary-transparent avatar-rounded">
                                            <i class="ti ti-gift fs-18"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 d-flex justify-content-between">
                                        <div>
                                            <p class="fw-semibold mb-0">
                                                <a href="notifications.html">Your Order Has Been Shipped</a>
                                            </p>
                                            <span class="text-muted fw-normal fs-12">
                                                Order No: 123456 Has Shipped To Your Delivery Address
                                            </span>
                                        </div>
                                        <a href="javascript:void(0);" class="text-muted dropdown-item-close1">
                                            <i class="ti ti-x fs-16"></i>
                                        </a>
                                    </div>
                                </div>
                            </li>

                            <!-- Notification Item 2 -->
                            <li class="dropdown-item">
                                <div class="d-flex align-items-start">
                                    <div class="pe-2">
                                        <span class="avatar avatar-md bg-secondary-transparent avatar-rounded">
                                            <i class="ti ti-discount-2 fs-18"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 d-flex justify-content-between">
                                        <div>
                                            <p class="fw-semibold mb-0">
                                                <a href="notifications.html">Discount Available</a>
                                            </p>
                                            <span class="text-muted fw-normal fs-12">
                                                Discount Available On Selected Products
                                            </span>
                                        </div>
                                        <a href="#" class="text-muted dropdown-item-close1">
                                            <i class="ti ti-x fs-16"></i>
                                        </a>
                                    </div>
                                </div>
                            </li>

                            <!-- Notification Item 3 -->
                            <li class="dropdown-item">
                                <div class="d-flex align-items-start">
                                    <div class="pe-2">
                                        <span class="avatar avatar-md bg-pink-transparent avatar-rounded">
                                            <i class="ti ti-user-check fs-18"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 d-flex justify-content-between">
                                        <div>
                                            <p class="fw-semibold mb-0">
                                                <a href="notifications.html">Account Has Been Verified</a>
                                            </p>
                                            <span class="text-muted fw-normal fs-12">
                                                Your Account Has Been Verified Successfully
                                            </span>
                                        </div>
                                        <a href="#" class="text-muted dropdown-item-close1">
                                            <i class="ti ti-x fs-16"></i>
                                        </a>
                                    </div>
                                </div>
                            </li>

                            <!-- Notification Item 4 -->
                            <li class="dropdown-item">
                                <div class="d-flex align-items-start">
                                    <div class="pe-2">
                                        <span class="avatar avatar-md bg-warning-transparent avatar-rounded">
                                            <i class="ti ti-circle-check fs-18"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 d-flex justify-content-between">
                                        <div>
                                            <p class="fw-semibold mb-0">
                                                <a href="notifications.html">
                                                    Order Placed <span class="text-warning">ID: #1116773</span>
                                                </a>
                                            </p>
                                            <span class="text-muted fw-normal fs-12">Order Placed Successfully</span>
                                        </div>
                                        <a href="#" class="text-muted dropdown-item-close1">
                                            <i class="ti ti-x fs-16"></i>
                                        </a>
                                    </div>
                                </div>
                            </li>

                            <!-- Notification Item 5 -->
                            <li class="dropdown-item">
                                <div class="d-flex align-items-start">
                                    <div class="pe-2">
                                        <span class="avatar avatar-md bg-success-transparent avatar-rounded">
                                            <i class="ti ti-clock fs-18"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 d-flex justify-content-between">
                                        <div>
                                            <p class="fw-semibold mb-0">
                                                <a href="notifications.html">
                                                    Order Delayed <span class="text-success">ID: 7731116</span>
                                                </a>
                                            </p>
                                            <span class="text-muted fw-normal fs-12">Order Delayed Unfortunately</span>
                                        </div>
                                        <a href="#" class="text-muted dropdown-item-close1">
                                            <i class="ti ti-x fs-16"></i>
                                        </a>
                                    </div>
                                </div>
                            </li>

                        </ul>

                        <div class="p-3 border-top d-grid empty-header-item1">
                            <a href="notifications.html" class="btn btn-primary">View All</a>
                        </div>

                        <div class="p-5 text-center d-none empty-item1">
                            <span class="avatar avatar-xl avatar-rounded bg-secondary-transparent">
                                <i class="ri-notification-off-line fs-2"></i>
                            </span>
                            <h6 class="fw-semibold mt-3">No New Notifications</h6>
                        </div>
                    </div>

                </div>

                <!-- End::Notifications -->

                <div class="language-dropdown">
                    @php $currentLocale = app()->getLocale(); @endphp

                    <button class="lang-btn" type="button" data-bs-toggle="dropdown">
                        <img src="{{ asset('assets/images/flags/' . $currentLocale . '.png') }}" width="20" height="14">
                        <span class="lang">{{ LaravelLocalization::getCurrentLocaleNative() }}</span>
                        <i class="bx bx-chevron-down"></i>
                    </button>

                    <ul class="dropdown-menu lang-menu">
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <li>
                            <a class="dropdown-item lang-item"
                                href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                <img src="{{ asset('assets/images/flags/' . $localeCode . '.png') }}" width="20" height="14">
                                <span>{{ $properties['native'] }}</span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>


                <!-- Fullscreen -->
                <div class="header-element header-fullscreen">
                    <a onclick="toggleFullscreen();" href="#" class="header-link">
                        <i class="bx bx-fullscreen full-screen-open header-link-icon d-block"></i>
                        <i class="bx bx-exit-fullscreen full-screen-close header-link-icon d-none"></i>
                    </a>
                </div>
                <!-- End::Fullscreen -->



                <!-- Profile -->
                <div class="header-element">
                    <a href="#" class="header-link dropdown-toggle" id="mainHeaderProfile" data-bs-toggle="dropdown">
                        <div class="d-flex align-items-center">
                            <div class="me-2">
                                <img src="{{ auth()->user()->image && file_exists(public_path('storage/'.auth()->user()->image)) 
            ? asset('storage/'.auth()->user()->image) 
            : asset('images/user.jpeg') }}" style="width:30px;height:30px">
                            </div>
                        </div>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="mainHeaderProfile" style="min-width: 200px;">
                        <li class="px-3 py-2">
                            <strong>{{ auth()->user()->name }}</strong><br>
                            <small class="text-muted">{{ auth()->user()->email }}</small>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        @php
                        $user = auth()->user();
                        @endphp

                        <li>
                            @if($user && $user->hasRole('SuperAdmin'))
                            <a class="dropdown-item" href="{{ route('get.profile') }}">
                                <i class="bx bx-user me-2"></i> Profile
                            </a>
                            @elseif($user && $user->hasRole('Admin'))
                            <a class="dropdown-item" href="{{ route('get.admin.profile') }}">
                                <i class="bx bx-user me-2"></i> Profile
                            </a>
                            @else
                            <a class="dropdown-item" href="{{ route('get.employee.profile') }}">
                                <i class="bx bx-user me-2"></i> Profile
                            </a>
                            @endif
                        </li>


                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="bx bx-log-out me-2"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>

                <!-- End::Profile -->



            </div>
            <!-- End::header-content-right -->

        </div>
    </header>
</div>