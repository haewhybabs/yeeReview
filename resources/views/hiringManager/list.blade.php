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
                                <h4 class="header-title">All {{ $organisation? $organisation->name:'' }} Hiring Managers</h4>
                            </div>
                            <div class="col-6 text-right">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createHiringManager">
                                    Create Hiring Manager
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
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($hiringManagers as $hiringManager)
                                    <tr>
                                        <td>{{ $hiringManager->user->first_name }} {{ $hiringManager->user->last_name }}</td>
                                        <td>{{ $hiringManager->user->email }}</td>
                                        <td>{{ $hiringManager->organisation->name }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
          
            
        </div>
    </div>
</div>
<div class="modal" id="createHiringManager">
    <div class="modal-dialog">
      <div class="modal-content">
  
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Create Hiring Manager</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
  
        <!-- Modal body -->
        <div class="modal-body">
          <form method="POST" action="{{ URL::TO('create-hiring-manager') }}">
            @csrf
            <h5>Account Authentication </h5><br>
            <div class="row">
                <div class="form-group col-6">
                    <label>First Name</label>
                    <input type="text" class="form-control" name="first_name" required />
                </div>
                <div class="form-group col-6">
                    <label>Last Name</label>
                    <input type="text" class="form-control" name="last_name" required  />
                </div>
            </div>

            <div class="row">
                <div class="form-group col-6">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" required />
                </div>
                <div class="form-group col-6">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" required  />
                </div>
            </div>
            @if($isAdmin)
                <div class="row">
                    
                    <div class="form-group col-6">
                        <label>Select Organisation</label>
                        <select  name="organisation_id" class="form-control">
                            @foreach ($organisations as $organisation )
                                <option value="{{ $organisation->id }}">{{ $organisation->name }}</option>
                            @endforeach
                            
                        </select>
                    </div>
                </div>
            @else
                <input type="hidden" name="organisation_id" value="{{ $organisation->id }}" />
            @endif
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