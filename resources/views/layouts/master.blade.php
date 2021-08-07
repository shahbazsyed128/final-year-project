<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Learning Management System</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Custom style -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    @stack('links')

    <style>
        .progress {
            position: relative;
            width: 100%;
            border: 1px solid #7F98B2;
            padding: 1px;
            border-radius: 3px;
        }

        .bar {
            background-color: #B4F5B4;
            width: 0%;
            height: 25px;
            border-radius: 3px;
        }

        .percent {
            position: absolute;
            display: inline-block;
            top: 3px;
            left: 48%;
            color: #7F98B2;
        }

    </style>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper" id="app" style="height:600px">
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center hide">
            <img class="animation__shake" src="{{ asset('img/logo.jpg') }}" alt="AdminLTELogo" height="60" width="60">
        </div>
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <a class="nav-link" href="{{ url('/logout') }}" role="button" data-tooltip="tooltip" title="Logout">
                    <i class="fa fa-power-off text-danger" aria-hidden="true"></i>
                </a>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <img src="{{ asset('img/logo.jpg') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                    style="opacity: .8">
                <span class="brand-text font-weight-light">LMS</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('img/user.png') }}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <h5 class="text-light">{{ Auth::user()->name }}</h5>
                        <p class="text-secondary">{{ ucfirst(Auth::user()->role) }}</p>
                    </div>
                </div>
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item ">
                            <a href="{{ route('home') }}"
                                class="nav-link {{ request()->is('home') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        @can('isAdmin')
                            <li
                                class="nav-item {{ request()->is('users*') || request()->is('pending') ? 'menu-open' : '' }}">
                                <a href="#"
                                    class="nav-link {{ request()->is('users*') || request()->is('pending') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>
                                        Users
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul
                                    class="nav nav-treeview {{ request()->is('users*') || request()->is('pending') ? 'show' : '' }}">
                                    <li class="nav-item">
                                        <a href="{{ route('user') }}"
                                            class="nav-link {{ request()->is('users') ? 'active' : '' }}">
                                            <i class="fa fa-users nav-icon"></i>
                                            <p>All Users</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('pending') }}"
                                            class="nav-link  {{ request()->is('pending') ? 'active' : '' }}">
                                            <i class="far fa-hourglass fa-xs position-absolute"></i><i
                                                class="fas fa-user nav-icon"></i>
                                            <p>Pending Approvals</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item {{ request()->is('courses*') ? 'menu-open' : '' }}">
                                <a href="#" class="nav-link  {{ request()->is('courses*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-graduation-cap"></i>
                                    <p>Courses
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview  {{ request()->is('courses*') ? 'show' : '' }}">
                                    <li class="nav-item">
                                        <a href="{{ route('courses.index') }}"
                                            class="nav-link {{ request()->is('courses') ? 'active' : '' }}">
                                            <i class="fas fa-user-graduate nav-icon"></i>
                                            <p>All Courses </p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('courses.create') }}"
                                            class="nav-link {{ request()->is('courses/create') ? 'active' : '' }}">
                                            <i class="fa fa-plus fa-xs position-absolute"></i>
                                            <i class="fas fa-book-reader nav-icon"></i>

                                            <p>Add Course</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('categories') }}"
                                            class="nav-link  {{ request()->is('categories') ? 'active' : '' }}">
                                            <i class="fas fa-cloud-upload-alt nav-icon"></i>
                                            <p>Course Categories</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item {{ request()->is('quiz*') ? 'menu-open' : '' }}">
                                <a href="#" class="nav-link  {{ request()->is('quiz*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-question"></i>
                                    <p>Quizzes
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview  {{ request()->is('quiz*') ? 'show' : '' }}">
                                    <li class="nav-item">
                                        <a href="{{ route('quiz') }}"
                                            class="nav-link {{ request()->is('quiz') ? 'active' : '' }}">
                                            <i class="fas fa-list nav-icon"></i>
                                            <p>All Quizzes </p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('quiz.create') }}"
                                            class="nav-link {{ request()->is('quiz/create') ? 'active' : '' }}">
                                            <i class="fa fa-plus fa-xs position-absolute"></i>
                                            <i class="fas fa-plus nav-icon"></i>
                                            <p>Add Quiz</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endcan

                        @can('isUser')
                            <li class="nav-item {{ request()->is('user*') ? 'menu-open' : '' }}">
                                <a href="#" class="nav-link  {{ request()->is('user*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-question"></i>
                                    <p>Courses
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview  {{ request()->is('user/view-courses') ? 'show' : '' }}">
                                    <li class="nav-item">
                                        <a href="{{ route('user.view-courses') }}"
                                            class="nav-link {{ request()->is('user/view-courses') ? 'active' : '' }}">
                                            <i class="fas fa-list nav-icon"></i>
                                            <p>All Courses </p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('user.registered-course') }}"
                                            class="nav-link {{ request()->is('user/registered-course') ? 'active' : '' }}">
                                            <i class="fas fa-list nav-icon"></i>
                                            <p>My Courses </p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item {{ request()->is('user/job*') ? 'menu-open' : '' }}">
                                <a href="#" class="nav-link  {{ request()->is('user/*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-briefcase"></i>
                                    <p>Jobs
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview  {{ request()->is('job*') ? 'show' : '' }}">
                                    <li class="nav-item">
                                        <a href="{{ route('jobs.view') }}"
                                            class="nav-link {{ request()->is('jobs/view') ? 'active' : '' }}">
                                            <i class="fas fa-list nav-icon"></i>
                                            <p>List All </p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('user.applied-jobs') }}"
                                            class="nav-link {{ request()->is('user/applied-jobs') ? 'active' : '' }}">
                                            <i class="fas fa-list nav-icon"></i>
                                            <p>Applied Jobs </p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            @can('isMentor')
                                <li class="nav-item {{ request()->is(['courses*', 'quiz*']) ? 'menu-open' : '' }}">
                                    <a href="#" class="nav-link  {{ request()->is(['courses*', 'quiz*']) ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-chalkboard-teacher"></i>
                                        <p>Become a mentor
                                            <i class="right fas fa-angle-left"></i>
                                            <span class="badge badge-info"><i class="fas fa-lock-open"></i></span>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview  {{ request()->is('user/view-courses') ? 'show' : '' }}">
                                        <li class="nav-item">
                                            <a href="{{ route('courses.index') }}"
                                                class="nav-link {{ request()->is('courses') ? 'active' : '' }}">
                                                <i class="fas fa-user-graduate nav-icon"></i>
                                                <p>All Courses </p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('courses.create') }}"
                                                class="nav-link {{ request()->is('courses/create') ? 'active' : '' }}">
                                                <i class="fa fa-plus fa-xs position-absolute"></i>
                                                <i class="fas fa-book-reader nav-icon"></i>

                                                <p>Add Course</p>
                                            </a>
                                        </li>
                                        <li class="nav-item {{ request()->is('quiz*') ? 'menu-open' : '' }}">
                                            <a href="#" class="nav-link  {{ request()->is('quiz*') ? 'active' : '' }}">
                                                <i class="nav-icon fas fa-question"></i>
                                                <p>Quizzes
                                                    <i class="right fas fa-angle-left"></i>
                                                </p>
                                            </a>
                                            <ul class="nav nav-treeview  {{ request()->is('quiz*') ? 'show' : '' }}">
                                                <li class="nav-item">
                                                    <a href="{{ route('quiz') }}"
                                                        class="nav-link {{ request()->is('quiz') ? 'active' : '' }}">
                                                        <i class="fas fa-list nav-icon"></i>
                                                        <p>All Quizzes </p>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="{{ route('quiz.create') }}"
                                                        class="nav-link {{ request()->is('quiz/create') ? 'active' : '' }}">
                                                        <i class="fa fa-plus fa-xs position-absolute"></i>
                                                        <i class="fas fa-plus nav-icon"></i>
                                                        <p>Add Quiz</p>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a href="#" class="nav-link {{ request()->is('courses') ? 'active' : '' }}">
                                        <i class="fas fa-chalkboard-teacher nav-icon"></i>
                                        <p>Become a mentor <span class="badge badge-danger"><i class="fas fa-lock"></i></span>
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            <li class="nav-item {{ request()->is(['users/*']) ? 'menu-open' : '' }}">
                                <a href="{{ route('users.show', Auth::user()->id) }}"
                                    class="nav-link {{ request()->is('users/*') ? 'active' : '' }}">
                                    <i class="fas fa-user-cog"></i>
                                    <p>Profile</p>
                                </a>
                            </li>
                        @endcan

                        @can('isCompany')
                            <li class="nav-item {{ request()->is('company*') ? 'menu-open' : '' }}">
                                <a href="#" class="nav-link  {{ request()->is('company*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-question"></i>
                                    <p>Jobs
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview  {{ request()->is('company/jobs') ? 'show' : '' }}">
                                    <li class="nav-item">
                                        <a href="{{ route('jobs.index') }}"
                                            class="nav-link {{ request()->is('company/jobs') ? 'active' : '' }}">
                                            <i class="fas fa-list nav-icon"></i>
                                            <p>Your Jobs </p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('jobs.create') }}"
                                            class="nav-link {{ request()->is('company/jobs/create') ? 'active' : '' }}">
                                            <i class="fas fa-list nav-icon"></i>
                                            <p>Add Job</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('company.jobs.applications') }}"
                                            class="nav-link {{ request()->is('company/jobs/applications') ? 'active' : '' }}">
                                            <i class="fas fa-list nav-icon"></i>
                                            <p>Applications</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('company.employees') }}"
                                            class="nav-link {{ request()->is('company/employees') ? 'active' : '' }}">
                                            <i class="fas fa-list nav-icon"></i>
                                            <p>Hired Users</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endcan
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
        <div class="content-wrapper">
            <!-- Content Wrapper. Contains page content -->
            @yield('content')


        </div>
        <!-- /.content-wrapper -->
    </div>
    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="float-right d-none d-sm-inline">

        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; {{ date('Y') }} <a href="#">LMS</a>.</strong> All rights reserved.
    </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('js/demo.js')}}"></script>
    <script src="{{ asset('js/adminlte.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    @if ($message = Session::get('success'))
        <script>
            Toast.fire({
                icon: 'success',
                title: "{{ $message }}"
            });
        </script>
    @endif
    @if ($message = Session::get('error'))
        <script>
            Toast.fire({
                icon: 'error',
                title: "{{ $message }}"
            });
        </script>
    @endif
    
    @stack('scripts')
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</body>

</html>
