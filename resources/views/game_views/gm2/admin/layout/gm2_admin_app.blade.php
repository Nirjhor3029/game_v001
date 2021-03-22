<!DOCTYPE html>
<html lang="en">
<?php $adminTle = 'assets/admintle/'; ?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Dashboard</title>

    <meta name="csrf-token" content="{{ csrf_token() }}"/>


    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset($adminTle) }}/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset($adminTle) }}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset($adminTle) }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset($adminTle) }}/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset($adminTle) }}/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset($adminTle) }}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset($adminTle) }}/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset($adminTle) }}/plugins/summernote/summernote-bs4.min.css">


    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset($adminTle) }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet"
        href="{{ asset($adminTle) }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset($adminTle) }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

<!-- Toastr js & Css :End -->


    <!-- Custom -->
    <link rel="stylesheet" href="{{ asset('css/game2_admin.css') }}">

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

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
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <form method="POST" action="{{route('logout')}}">
                    @csrf
                    <a class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out" href="{{route('logout')}}" onclick="event.preventDefault();this.closest('form').submit();">Logout</a>
                </form>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <img src="{{ asset($adminTle) }}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                    style="opacity: .8">
                <span class="brand-text font-weight-light">Game</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <!-- <div class="image">
                        <img src="{{ asset($adminTle) }}/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div> -->
                    <div class="info">
                        <a href="#" class="d-block">Strategic Game</a>
                    </div>
                </div>



                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                            <!-- Add icons to the links using the .nav-icon class
                            with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="{{route('teacher.dashboard')}}" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                    <!-- <i class="right fas fa-angle-left"></i> -->
                                </p>
                            </a>

                        </li>

                        <li class="nav-item active menu-open">
                            <a href="#" class="nav-link ">
                                <i class="nav-icon fas fa-gamepad"></i>
                                <p>
                                    Simulation
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('teacher.criteria_combination')}}" class="nav-link {{ Request::is('teacher/criteria_combination') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Criteria Combination</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('teacher.set_group2')}}" class="nav-link {{ Request::is('teacher/set_group') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Set Group</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('teacher.set_restaurant2')}}" class="nav-link {{ Request::is('teacher/set_restaurant') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Set Restaurant</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('teacher.assign_student')}}" class="nav-link {{ Request::is('teacher/assign_student') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Assign Student</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('teacher.attacker_list')}}" class="nav-link {{ Request::is('teacher/attacker_list') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Attacker List</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('teacher.set_time')}}" class="nav-link {{ Request::is('teacher/set_time') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Set Time</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <!-- <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-table"></i>
                                <p>
                                    Tables
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="pages/tables/simple.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Simple Tables</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/tables/data.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>DataTables</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/tables/jsgrid.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>jsGrid</p>
                                    </a>
                                </li>
                            </ul>
                        </li> -->


                        <!-- <li class="nav-header">EXAMPLES</li>
                        <li class="nav-item">
                            <a href="pages/calendar.html" class="nav-link">
                                <i class="nav-icon far fa-calendar-alt"></i>
                                <p>
                                    Calendar
                                    <span class="badge badge-info right">2</span>
                                </p>
                            </a>
                        </li>

                        <li class="nav-header">MISCELLANEOUS</li>
                        <li class="nav-item">
                            <a href="https://adminlte.io/docs/3.1/" class="nav-link">
                                <i class="nav-icon fas fa-file"></i>
                                <p>Documentation</p>
                            </a>
                        </li> -->


                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <!-- Main content -->
            <section class="content" >
                <div class="container-fluid " style="padding-top: 2vh;">

                    <div class="flash-message mt-9vh">
                        @foreach (['danger', 'warning', 'success', 'info'] as $msg)

                        @if(Session::has('alert-' . $msg))

                        <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                        @endif
                        @endforeach
                    </div> <!-- end .flash-message -->
                    @yield('content')
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->



    </div>
    <!-- ./wrapper -->







    <!-- jQuery -->
    <script src="{{ asset($adminTle) }}/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset($adminTle) }}/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)

    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset($adminTle) }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <!-- <script src="{{ asset($adminTle) }}/plugins/chart.js/Chart.min.js"></script> -->
    <!-- Sparkline -->
    <!-- <script src="{{ asset($adminTle) }}/plugins/sparklines/sparkline.js"></script> -->
    <!-- JQVMap -->
    <!-- <script src="{{ asset($adminTle) }}/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="{{ asset($adminTle) }}/plugins/jqvmap/maps/jquery.vmap.usa.js"></script> -->
    <!-- jQuery Knob Chart -->
    <!-- <script src="{{ asset($adminTle) }}/plugins/jquery-knob/jquery.knob.min.js"></script> -->
    <!-- daterangepicker -->
    <script src="{{ asset($adminTle) }}/plugins/moment/moment.min.js"></script>
    <script src="{{ asset($adminTle) }}/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <!-- <script src="{{ asset($adminTle) }}/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"> -->
    </script>
    <!-- Summernote -->
    <script src="{{ asset($adminTle) }}/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset($adminTle) }}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset($adminTle) }}/dist/js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset($adminTle) }}/dist/js/demo.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <!-- <script src="{{ asset($adminTle) }}/dist/js/pages/dashboard.js"></script> -->



    <!-- DataTables  & Plugins -->
    <!-- <script src="{{ asset($adminTle) }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset($adminTle) }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset($adminTle) }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset($adminTle) }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ asset($adminTle) }}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset($adminTle) }}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ asset($adminTle) }}/plugins/jszip/jszip.min.js"></script>
    <script src="{{ asset($adminTle) }}/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="{{ asset($adminTle) }}/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="{{ asset($adminTle) }}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ asset($adminTle) }}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="{{ asset($adminTle) }}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script> -->

    <!-- Custom -->

    <!-- Toastr js & Css :start -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script src="{{ asset('js/game2_admin.js') }}"></script>


    @stack('js')

</body>

</html>
