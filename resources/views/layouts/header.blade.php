<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="{{URL::TO('assets/images/icon/favicon.ico')}}">
    <link rel="stylesheet" href="{{URL::TO('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{URL::TO('assets/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{URL::TO('assets/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{URL::TO('assets/css/metisMenu.css')}}">
    <link rel="stylesheet" href="{{URL::TO('assets/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{URL::TO('assets/css/slicknav.min.css')}}">
    <!-- Start datatable css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- others css -->
    <link rel="stylesheet" href="{{URL::TO('assets/css/typography.css')}}">
    <link rel="stylesheet" href="{{URL::TO('assets/css/default-css.css')}}">
    <link rel="stylesheet" href="{{URL::TO('assets/css/styles.css')}}">
    <link rel="stylesheet" href="{{URL::TO('assets/css/main.css')}}">
    <link rel="stylesheet" href="{{URL::TO('assets/css/responsive.css')}}">
    {{-- Toastr --}}
    <link rel="stylesheet" href="{{asset('assets/css/toastr.css')}}">
    <!-- modernizr css -->
    <script src="{{URL::TO('assets/js/vendor/modernizr-2.8.3.min.js')}}"></script>
</head>

<body>
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <div class="page-container">
        <!-- sidebar menu area start -->
        <div class="sidebar-menu">
            <div class="sidebar-header">
                <div class="logo">
                    <a href="index.html"><h4 class="default-header">{{ env('APP_NAME') }}</h4></a>
                </div>
            </div>
            <div class="main-menu">
                <div class="menu-inner">
                    @if(auth()->user()->role_id==env("ADMIN_ROLE"))
                        <nav>
                            <ul class="metismenu" id="menu">
                                <li><a href="maps.html"><i class="ti-dashboard"></i> <span>Dashboard</span></a></li>
                                <li><a href="maps.html"><i class="ti-receipt"></i> <span>Hiring Managers</span></a></li>
                                <li><a href="{{ URL::TO("organisations") }}"><i class="ti-palette"></i> <span>Organisations</span></a></li>
                                <li><a href="{{ URL::TO("employees") }}"><i class="fa fa-user"></i> <span>Employees</span></a></li>
                                <li><a href="maps.html"><i class="ti-layout-sidebar-left"></i> <span>Recruitment</span></a></li>
                                <li>
                                    <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>Reviews</span></a>
                                    <ul class="collapse">
                                        <li><a href="index.html">Goals</a></li>
                                        <li><a href="index.html">Reviews</a></li>
                                        <li class="active"><a href="index2.html">Feedbacks</a></li>
                                    </ul>
                                </li>

                                <li><a href="{{ URL::TO('signout') }}"><i class="fa fa-sign-out"></i> <span>Signout</span></a></li>
                            </ul>
                        </nav>
                    @elseif (auth()->user()->role_id==env('ORGANISATION_ROLE'))
                        <nav>
                            <ul class="metismenu" id="menu">
                                <li><a href="maps.html"><i class="ti-dashboard"></i> <span>Dashboard</span></a></li>
                                <li><a href="maps.html"><i class="ti-receipt"></i> <span>Hiring Managers</span></a></li>
                                <li><a href="maps.html"><i class="fa fa-user"></i> <span>Employees</span></a></li>
                                <li><a href="maps.html"><i class="ti-layout-sidebar-left"></i> <span>Recruitment</span></a></li>
                                <li>
                                    <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>Reviews</span></a>
                                    <ul class="collapse">
                                        <li><a href="index.html">Goals</a></li>
                                        <li><a href="index.html">KPI Reviews</a></li>
                                        <li class="active"><a href="index2.html">Feedbacks</a></li>
                                    </ul>
                                </li>

                                <li><a href="{{ URL::TO('signout') }}"><i class="fa fa-sign-out"></i> <span>Signout</span></a></li>
                            </ul>
                        </nav>
                    @elseif (auth()->user()->role_id==env('EMPLOYEE_ROLE'))
                        <nav>
                            <ul class="metismenu" id="menu">
                                <li><a href="maps.html"><i class="ti-dashboard"></i> <span>Dashboard</span></a></li>
                                <li><a href="maps.html"><i class="ti-receipt"></i> <span>Hiring Managers</span></a></li>
                                <li><a href="maps.html"><i class="ti-palette"></i> <span>Organisations</span></a></li>
                                <li><a href="maps.html"><i class="fa fa-user"></i> <span>Employees</span></a></li>
                                <li><a href="maps.html"><i class="ti-layout-sidebar-left"></i> <span>Recruitment</span></a></li>
                                <li>
                                    <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>Reviews</span></a>
                                    <ul class="collapse">
                                        <li><a href="index.html">Goals</a></li>
                                        <li><a href="index.html">Reviews</a></li>
                                        <li class="active"><a href="index2.html">Feedbacks</a></li>
                                    </ul>
                                </li>

                                <li><a href="{{ URL::TO('signout') }}"><i class="fa fa-sign-out"></i> <span>Signout</span></a></li>
                            </ul>
                        </nav>
                    @else
                        <nav>
                            <ul class="metismenu" id="menu">
                                <li><a href="maps.html"><i class="ti-dashboard"></i> <span>Dashboard</span></a></li>
                                <li><a href="maps.html"><i class="ti-receipt"></i> <span>Hiring Managers</span></a></li>
                                <li><a href="maps.html"><i class="ti-palette"></i> <span>Organisations</span></a></li>
                                <li><a href="maps.html"><i class="fa fa-user"></i> <span>Employees</span></a></li>
                                <li><a href="maps.html"><i class="ti-layout-sidebar-left"></i> <span>Recruitment</span></a></li>
                                <li>
                                    <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>Reviews</span></a>
                                    <ul class="collapse">
                                        <li><a href="index.html">Goals</a></li>
                                        <li><a href="index.html">Reviews</a></li>
                                        <li class="active"><a href="index2.html">Feedbacks</a></li>
                                    </ul>
                                </li>

                                <li><a href="{{ URL::TO('signout') }}"><i class="fa fa-sign-out"></i> <span>Signout</span></a></li>
                            </ul>
                        </nav>
                    @endif
                </div>
            </div>
        </div>
        <!-- sidebar menu area end -->
        <!-- main content area start -->
        <div class="main-content">
            <!-- header area start -->
            <div class="header-area">
                <div class="row align-items-center">
                    <!-- nav and search button -->
                    <div class="col-md-6 col-sm-8 clearfix">
                        <div class="nav-btn pull-left">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        
                    </div>
                    
                    
                </div>
            </div>