<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}" data-nav-layout="vertical" data-theme-mode="light" data-header-styles="light"
    data-menu-styles="light" data-toggled="close">

<head>
    <!-- Start Meta Data -->
    <meta charset="UTF-8" />
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />

    <meta name="Description" content="Police" />
    <meta name="Author" content="Police" />
    <meta name="keywords" content="Police" />

    <!-- End Meta Data -->

    <!-- Title -->
    <title>
        @yield('title')
    </title>
    @php
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Route;

    @endphp
    <!-- Favicon Icon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/images/favicon/apple-touch-icon.png')}}" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/favicon/favicon-32x32.png')}}" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon/favicon-16x16.png')}}" />
    <link rel="manifest" href="{{ asset('assets/images/favicon/site.webmanifest')}}" />
    <link rel="mask-icon" href="{{ asset('assets/images/favicon/safari-pinned-tab.svg')}}" color="#a01b20" />
    <meta name="msapplication-TileColor" content="#a01b20" />
    <meta name="theme-color" content="#a01b20" />

    <!-- Main Theme Js -->
    <script src="{{ asset('assets/js/main.js')}}"></script>

    <!-- Bootstrap Css -->
    <link id="style" href="{{ asset('assets/libs/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" />

    <!-- Style Css -->
    <link href="{{ asset('assets/css/styles.min.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    @if(app()->getLocale() === 'ar')
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.rtl.min.css') }}">
    @else
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    @endif

    <!-- Icons Css -->
    <link href="{{ asset('assets/icon-fonts/icons.css')}}" rel="stylesheet" />


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        .form-check-input:checked {
            background-color: #28a745;
            /* أخضر */
            border-color: #28a745;
        }

        .form-check-input:not(:checked) {
            background-color: #dc3545;
            /* أحمر */
            border-color: #dc3545;
        }

        .search-container {
            max-width: 400px;
            margin: 2rem 2rem 1rem auto !important;
        }

        .filter-container {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin: 1rem 2rem;
        }

        .filter-container select {
            min-width: 200px;
        }

        #btn_delete_all {
            background-color: #ccc;
            width: 300px;
            color: red;
            pointer-events: unset !important;

        }

        #btn_delete_all:disabled {
            cursor: not-allowed;
        }


        #btn_send_all {
            background-color: #aaa;
            width: 300px;
            color: red;
            pointer-events: unset !important;
        }

        #btn_send_all:disabled {
            cursor: not-allowed;
        }

        .subcategory-container {
            display: none;
            /* Hide subcategory by default */
        }

        .action-buttons {
            margin: 0 2rem 1rem;
        }

        .select2-container {
            width: 100% !important;
        }

        .select2-selection--multiple {
            min-height: 38px !important;
        }

        .filters-applied {
            margin: 0 2rem 1rem;
            padding: 10px;
            background-color: #f8f9fa;
            border-radius: 5px;
        }

        .filter-badge {
            display: inline-block;
            margin: 2px;
            padding: 3px 8px;
            background-color: #e9ecef;
            border-radius: 4px;
            font-size: 0.8rem;
        }

        .page {
            min-height: auto !important
        }

        .app-content {
            margin-left: 260px !important;
        }

        html[lang="ar"] .app-content {
            margin-right: 260px !important;
            margin-left: 0 !important;
        }

        .my-4 {
            margin-top: 0 !important;
            margin-bottom: 1.5rem !important;
        }

        .sidebar-collapsed #sidebar {
            margin-left: -260px;
            transition: all 0.3s ease;
        }

        #sidebar {
            transition: all 0.3s ease;
        }

        .lang-btn {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            padding: 6px 12px;
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .lang-btn:hover {
            background: #f9fafb;
            border-color: #d1d5db;
        }

        .lang-btn i {
            font-size: 18px;
        }


        .lang-menu {
            border: none !important;
            border-radius: 10px;
            padding: 8px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            min-width: 160px;
        }

        .lang-item {
            display: flex !important;
            align-items: center;
            gap: 10px;
            padding: 8px 12px !important;
            border-radius: 8px;
            transition: background 0.2s ease;
        }

        .lang-item:hover {
            background: #f3f4f6;
        }

        .dropdown-item:active {
            background-color: #e5e7eb !important;
        }
    </style>

    <!---------------------------------------the End Style in home blade header -------------------------------------------->
    @yield('css');



    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>


    <![endif]-->


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let toggleBtn = document.querySelector('.sidemenu-toggle');
            toggleBtn.addEventListener('click', function() {
                document.body.classList.toggle('sidebar-collapsed');
            });
        });
    </script>

    <script>
        function toggleFullscreen() {
            if (!document.fullscreenElement) {
                document.documentElement.requestFullscreen();
                document.querySelector('.full-screen-open').classList.add('d-none');
                document.querySelector('.full-screen-close').classList.remove('d-none');

            } else {
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                }

                document.querySelector('.full-screen-open').classList.remove('d-none');
                document.querySelector('.full-screen-close').classList.add('d-none');
            }
        }
    </script>


</head>

<body>