<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="ar">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>@yield('page-title')</title>


    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('cms-style/dist/font-awesome/css/font-awesome.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('cms-style/dist/adminlte/css/adminlte.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="{{ asset('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700') }}"
        rel="stylesheet">
    <!-- bootstrap rtl -->
    <link rel="stylesheet" href="{{ asset('cms-style/dist/adminlte/css/bootstrap-rtl.min.css') }}">
    <!-- template rtl version -->
    <link rel="stylesheet" href="{{ asset('cms-style/dist/adminlte/css/custom-style.css') }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <!-- Bootstrap Font Icon CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @yield('css')
    <style>
        a {
            text-decoration: none
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href=""><i class="fa fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('index_classroom') }}" class="nav-link">الصفحة الرئيسية</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="" class="nav-link">اتصل بنا</a>
                </li>
            </ul>

            <!-- SEARCH FORM -->
            <form class="form-inline ml-3">
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" type="search" placeholder="بحث..."
                        aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>

            <!-- Right navbar links -->
            {{-- <ul class="navbar-nav mr-auto">
                <!-- Messages Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fa fa-comments-o"></i>
                        <span class="badge badge-danger navbar-badge">3</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-left">
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 ml-3 img-circle">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        بدران عوض
                                        <span class="float-left text-sm text-danger"><i class="fa fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">اتصل بي من فضلك ...</p>
                                    <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i> منذ 4 ساعات </p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle ml-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        پیمان احمدی
                                        <span class="float-left text-sm text-muted"><i class="fa fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">وصلتني رسالتك</p>
                                    <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i> منذ 4 ساعات</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle ml-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        سارا وکیلی
                                        <span class="float-left text-sm text-warning"><i class="fa fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">كان مشروعك رائعًا حقًا</p>
                                    <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i>منذ 4 ساعات</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">عرض جميع الرسائل</a>
                    </div>
                </li>
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell-o"></i>
                        <span class="badge badge-warning navbar-badge">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-left">
                        <span class="dropdown-item dropdown-header">15 اشعار</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fa fa-envelope ml-2"></i> 4 رسائل جديدة
                            <span class="float-left text-muted text-sm">3 دقائق</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fa fa-users ml-2"></i> 8 طلبات صداقة
                            <span class="float-left text-muted text-sm">12 ساعة</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fa fa-file ml-2"></i> 3 تقارير جديدة
                            <span class="float-left text-muted text-sm">2 يوم</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">عرض جميع الإخطارات</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i
                class="fa fa-th-large"></i></a>
                </li>
            </ul> --}}
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <img src="{{ asset('cms-style/dist/img/classroom_Logo.png') }}" alt="classroom Logo" class="brand-image"
                    style="witd:80px;height:80px;">
                <span class="brand-text font-weight-light">{{ Config('app.name') }}</span>
            </a>
            <!-- Sidebar -->
            <div class="sidebar">
                <div>
                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img src="{{asset("uploads/".Auth::user()->user_image)}}"
                                class="img-circle elevation-2" alt="User Image">
                        </div>
                        <div class="info">
                            <a href="" class="d-block">مرحبا {{ Auth::user()->name }}</a>
                        </div>
                    </div>

                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                            data-accordion="false">
                            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
                            <li class="nav-item has-treeview menu-open">
                                <a href="#" class="nav-link active">
                                    <i class="nav-icon fa fa-dashboard"></i>
                                    <p>
                                        الفصول الدراسية
                                        <i class="right fa fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">

                                        <a href="{{ route('index_classroom') }}" class="nav-link {{-- active --}}">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>جميع الفصول الدراسية</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('trashed_classroom') }}" class="nav-link">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>الفصول الدراسية المحذوفة</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('create_classroom') }}" class="nav-link">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>إضافة فصل دراسي</p>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="{{ route('my_classroom') }}" class="nav-link">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>الفصول المنظم إليها</p>
                                        </a>
                                    </li>

                                </ul>
                            </li>
                          
                            <li class="nav-item has-treeview menu-open">
                                <a href="#" class="nav-link active">
                                    <i class="nav-icon fa fa-dashboard"></i>
                                    <p>
                                        المواضيع
                                        <i class="right fa fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">

                                        <a href="{{ route('topics.index') }}" class="nav-link {{-- active --}}">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>جميع المواضيع</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('topics.create') }}" class="nav-link">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>إضافة موضوع</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            {{-- start notifications --}}
                            <x-user-notifications-menu count="10"/>
                          
                            {{-- end notifications --}}
                                <form  class="nav-item"  action="{{route("logout")}}" method="post">
                                    @csrf
                                    <button class="btn " style="wieth:100%;color:white" type="submit">logout</button>
                                </form>
                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">@yield('big-title')</h1>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-left">
                                <li class="breadcrumb-item"><a href="#">@yield('big-title')</a></li>
                                <span>/</span>
                                <li class="breadcrumb-item active">@yield('small-title')</li>
                            </ol>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->


        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                جميع الحقوق محفوظة لدى صهيب أبو شعر
            </div>
            <span> - </span>

            <!-- Default to the left -->
            <strong>تم تطويره &copy; {{ now()->year }} <a
                    href="https://teal-duckanoo-7220ef.netlify.app/?fbclid=PAAaZPridL5HlxKRNiVJNP9t25DwqKEOxYjpAD6AeBJKHoMWjsHJMExwNaBJ0_aem_Ae2r6q_eimc2vVlw1ksBbJAQoPan1j_hpKX8fQQqSygppbWHRxwh9UwjnHqLSBJ3OTQ">صهيب
                    أبو شعر </a>.</strong>
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{ asset('cms-style/dist/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('cms-style/dist/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('cms-style/dist/adminlte/js/adminlte.min.js') }}"></script>
    @yield('js')
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
    <script>
    
        var userId={{Auth::id()}}

    </script>
    @vite(["resources/js/app.js"])
</body>
