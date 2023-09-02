@extends('layouts.main')
@section('content')
<div>
    <div class="page-title-area">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="breadcrumbs-area clearfix">
                    <ul class="breadcrumbs pull-left">
                        <li><a href="{{ URL::TO("dashboard") }}">Home</a></li>
                        <li><span>Employees</span></li>
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
                                <h4 class="header-title">All Employees</h4>
                            </div>
                            <div class="col-6 text-right">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createEmployee">
                                    Create Employee
                                </button>
                            </div>
                        </div><br>
                        <div class="data-tables">
                            <table id="dataTable" class="text-center">
                                <thead class="bg-light text-capitalize">
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Department</th>
                                        <th>Current Organisation</th>
                                        <th>Review</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($employees as $employee)
                                    <tr>
                                        <td>{{ $employee->user?->first_name }} {{ $employee->user?->last_name }}</td>
                                        <td>{{ $employee->user?->email }}</td>
                                        <td>{{ $employee->department?->name }}</td>
                                        <td>{{ $employee->organisation?->name }}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#list{{ $employee->id }}">
                                                View
                                              </button>
                                        </td>
                                        
                                        <td>
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#list{{ $employee->id }}">
                                                View
                                              </button>
                                        </td>
                                
                                    </tr>
                                    
                                      
                                      <!-- The Modal -->
                                      <div class="modal" id="list{{ $employee->id }}">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                      
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                              <h4 class="modal-title">Employee Details</h4>
                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                      
                                            <!-- Modal body -->
                                            <div class="modal-body">
                                              
                                            
                                            </div>
                                      
                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                            </div>
                                      
                                          </div>
                                        </div>
                                      </div>
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

{{-- modal --}}
<div class="modal" id="createEmployee">
    <div class="modal-dialog">
      <div class="modal-content">
  
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Create Employee</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
  
        <!-- Modal body -->
        <div class="modal-body">
          <form>
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
            <hr />
            <h5>Employee Details</h5><br>
            <div class="row">
                <div class="form-group col-6">
                    <label>Address</label>
                    <input type="text" class="form-control" name="address" required />
                </div>
                <div class="form-group col-6">
                    <label>Date of birth</label>
                    <input type="date" class="form-control" name="dob" required  />
                </div>
            </div>

            <div class="row">
                <div class="form-group col-6">
                    <label>Position</label>
                    <input type="text" class="form-control" name="position" required />
                </div>
                <div class="form-group col-6">
                    <label>Marital Status</label>
                    <select  name="marital_status" class="form-control">
                        <option value="single">Single</option>
                        <option value="married">Married</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-6">
                    <label>Position</label>
                    <input type="text" class="form-control" name="position" required />
                </div>
                <div class="form-group col-6">
                    <label>Deparments</label>
                    <select  name="department_id" class="form-control">
                        @foreach ($departments as $department )
                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                        @endforeach
                        
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-6">
                    <label>National Id</label>
                    <input type="text" class="form-control" name="national_id" required />
                </div>
                <div class="form-group col-6">
                    <label>Phone Number</label>
                    <input type="text" class="form-control" name="phone_number" required />
                </div>
            </div>

            <div class="row">
                <div class="form-group col-6">
                    <label>Employee Bio</label>
                    <textarea class="form-control" rows="5" name="required"></textarea>
                </div>
                <div class="form-group col-6">
                    <label>Select Organisation</label>
                    <select  name="current_organisation_id" class="form-control">
                        @foreach ($organisations as $organisation )
                            <option value="{{ $organisation->id }}">{{ $organisation->name }}</option>
                        @endforeach
                        
                    </select>
                </div>
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