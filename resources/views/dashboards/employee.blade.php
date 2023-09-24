@extends('layouts.main')
@section('content')
<div>
    <div class="page-title-area">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="breadcrumbs-area clearfix">
                    <h4 class="page-title pull-left">Dashboard</h4>
                    <ul class="breadcrumbs pull-left">
                        <li><a href="{{ URL::TO("dashboard") }}">Home</a></li>
                        <li><span>Dashboard</span></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-6 clearfix">
                <div class="user-profile pull-right">
                    <img class="avatar user-thumb" src="assets/images/author/avatar.png" alt="avatar">
                    <h4 class="user-name dropdown-toggle" data-toggle="dropdown">{{ auth()->user()->first_name }} <i class="fa fa-angle-down"></i></h4>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ URL::TO("signout") }}">Log Out</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
    <div class="main-content-inner">
        <div class="sales-report-area sales-style-two">
            <div class="row">
                <div class="col-xl-3 col-ml-3 col-md-6 mt-5">
                    <div class="single-report">
                        <div class="s-sale-inner pt--30 mb-3">
                            <div class="s-report-title d-flex justify-content-between">
                                <h4 class="header-title mb-0">Goals</h4>
                                <p>{{ $goals }}</p>
                            </div>
                        </div>
                        {{-- <canvas id="coin_sales4" height="100"></canvas> --}}
                    </div>
                </div>
                <div class="col-xl-3 col-ml-3 col-md-6 mt-5">
                    <div class="single-report">
                        <div class="s-sale-inner pt--30 mb-3">
                            <div class="s-report-title d-flex justify-content-between">
                                <h4 class="header-title mb-0">Completed Goals</h4>
                                <p>{{ $completedGoals }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-ml-3 col-md-6  mt-5">
                    <div class="single-report">
                        <div class="s-sale-inner pt--30 mb-3">
                            <div class="s-report-title d-flex justify-content-between">
                                <h4 class="header-title mb-0">Performances</h4>
                                    <p>{{ $performances }}</p>
                                
                            </div>
                        </div>
                    
                    </div>
                </div>
               <div class="col-xl-3 col-ml-3 col-md-6 mt-5">
                    <div class="single-report">
                        <div class="s-sale-inner pt--30 mb-3">
                            <div class="s-report-title d-flex justify-content-between">
                                <h4 class="header-title mb-0">Organisations</h4>
                                <p>{{ $organisations }}</p>
                                
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection