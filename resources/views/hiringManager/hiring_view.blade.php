@extends('layouts.main')
@section('content')
<div>
    <div class="page-title-area">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="breadcrumbs-area clearfix">
                    <ul class="breadcrumbs pull-left">
                        <li><a href="{{ URL::TO("dashboard") }}">Home</a></li>
                        <li><span>Organisations</span></li>
                    </ul>
                </div>
            </div>
            
        </div>
    </div>
    <!-- page title area end -->
    <div class="main-content-inner">
        <div class="row">
            <!-- data table start -->
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <h4 class="header-title">{{ $organisation? $organisation->name:'' }} Hiring Manager</h4>
                            </div>
                            <div class="col-6 text-right">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#updateHiringManager">
                                    Update Hiring Manager
                                </button>
                            </div>
                        </div><br>
                        <div class="data-tables">
                            <table id="dataTable" class="text-center">
                                <thead class="bg-light text-capitalize">
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Organisation</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <tr>
                                        <td>{{ $hiringManager->user->first_name }} {{ $hiringManager->user->last_name }}</td>
                                        <td>{{ $hiringManager->user->email }}</td>
                                        <td>{{ $hiringManager->organisation->name }}</td>
                                        <td> </td>
                                        <td> </td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="updateHiringManager">
    <div class="modal-dialog">
      <div class="modal-content">
  
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Update Hiring Manager</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <div class="modal-body">
          <form method="POST" action="{{ URL::TO('update-hiring-manager') }}">
            @csrf
            <h5>Account Authentication </h5><br>
            <div class="row">
                <div class="form-group col-6">
                    <label>First Name</label>
                    <input type="text" class="form-control" name="first_name" required value="{{ $hiringManager->user->first_name }}"/>
                </div>
                <div class="form-group col-6">
                    <label>Last Name</label>
                    <input type="text" class="form-control" name="last_name" value="{{ $hiringManager->user->last_name }}" required  />
                </div>
            </div>

            <div class="row">
                <div class="form-group col-6">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" value="{{ $hiringManager->user->email }}" required disabled/>
                </div>
            </div>
            <hr />
            <div class="text-center">
                <button class="btn btn-primary" type="submit">Submit</button>
            </div>
          </form>
        
        </div>
  
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
  
      </div>
    </div>
</div>
@endsection