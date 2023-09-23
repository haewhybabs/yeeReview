@extends('layouts.main')
@section('content')
<div>
    <div class="page-title-area">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="breadcrumbs-area clearfix">
                    <ul class="breadcrumbs pull-left">
                        <li><a href="{{ URL::TO("dashboard") }}">Home</a></li>
                        <li><span>Goals</span></li>
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
                                <h4 class="header-title">All Goals</h4>
                                {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#filterGoals">
                                    Filter
                                </button> --}}
                            </div>
                            {{-- <div class="col-6 text-right">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createGoal">
                                    Create Goal
                                </button>
                            </div> --}}
                        </div><br>
                        <div class="data-tables">
                            <table id="dataTable" class="text-center">
                                <thead class="bg-light text-capitalize">
                                    <tr>
                                        <th>Goal Name</th>
                                        <th>Employee Name</th>
                                        <th>Organisation</th>
                                        <th>Year</th>
                                        <th>Quarter</th>
                                        <th>View more</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($goals as $goal)
                                    <tr>
                                        <td>{{ $goal->goal_name }}</td>
                                        <td>{{ $goal->employee?->user?->first_name }} {{ $goal->employee?->user?->last_name }}</td>
                                        <td>{{ $goal->organisation?->name }}</td>
                                        <td>{{ $goal->year }}</td>
                                        <td>{{ $goal->quarter->name }}</td>
                                        
                                        <td>
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#view{{ $goal->id }}">
                                                View
                                              </button>
                                        </td>
                                        
                                        <td></td>
                                        <td></td>
                                
                                    </tr>
                                    
                                      
                                      <!-- The Modal -->
                                      <div class="modal" id="view{{ $goal->id }}">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                      
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                              <h4 class="modal-title">Goal Details</h4>
                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                      
                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <p>Employee Name: {{ $goal->employee?->user?->first_name }} {{ $goal->employee?->user->last_name }}</p>
                                                <p>Goal: {{ $goal->name }}</p>
                                                <p>Description: {{ $goal->description }}</p>
                                                <p>Year: {{ $goal->year }}</p>
                                                <p>Quarter: {{ $goal->quarter->name }}</p>
                                                <p>Expected Days: {{ $goal->expected_days }}</p>
                                                <p>Organisation: {{ $goal->organisation->name }}</p>
                                                <p>Delivered Days: {{ $goal->delivered_days }}</p>
                                                <p>Status: {{ $goal->status }}</p>
                                                <p>Weight: {{ $goal->weight }}</p>
                                              
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

<div class="modal" id="filterGoals">
    <div class="modal-dialog">
      <div class="modal-content">
  
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Filter Goals</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
  
        <!-- Modal body -->
        
        <div class="modal-body">
          <form method="GET" action="{{ URL::TO('goals') }}">
            @csrf
            @if($isAdmin)
                <div class="form-group">
                    <label>Select Organisation</label>
                    <select name="organisation_id" id="organisation-select2" class="form-control">
                        <option value="{{ 0 }}">Select Organisation</option>
                        @foreach ($organisations as $organisation )
                            <option value="{{ $organisation->id }}">{{ $organisation->name }}</option>
                        @endforeach
                        
                    </select>
                </div>
                <div class="form-group">
                    
                    <select name="employee_id" id="employee-select2" class="form-control">
                        <option value="0">Select Employee</option>
                        <!-- Options will be populated dynamically using JavaScript -->
                    </select>
                </div>
            @else
                <input type="hidden" name="organisation_id" value="{{ $organisation->id }}" />
                <div class="form-group">
                
                    <select name="employee_id" class="form-control">
                        <option value="0">Select Employee</option>
                        @foreach ($employees as $employee )
                            <option value="{{ $employee->id }}">{{ $employee->user->first_name }}</option>
                        @endforeach
                        <!-- Options will be populated dynamically using JavaScript -->
                    </select>
                </div>

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


<script>
    document.getElementById('organisation-select').addEventListener('change', function () {
        var selectedOrganizationId = this.value;
        var employeeSelect = document.getElementById('employee-select');
        
        // Clear the current employee options
        employeeSelect.innerHTML = '';
        fetch('{{ URL::TO('get-employees') }}/' + selectedOrganizationId)
            .then(response => response.json())
            .then(data => {
                
                data.forEach(function (employee) {
                    var option = document.createElement('option');
                    option.value = employee.id;
                    option.textContent = employee.name;
                    employeeSelect.appendChild(option);
                });
            })
            .catch(error => console.log(error));
    });

    document.getElementById('organisation-select2').addEventListener('change', function () {
        var selectedOrganizationId = this.value;
        var employeeSelect = document.getElementById('employee-select2');
        
        // Clear the current employee options
        employeeSelect.innerHTML = '';
        fetch('{{ URL::TO('get-employees') }}/' + selectedOrganizationId)
            .then(response => response.json())
            .then(data => {

                var option = document.createElement('option');
                option.value = 0
                option.textContent = "Select Employee"
                employeeSelect.appendChild(option);
                
                data.forEach(function (employee) {
                    var option = document.createElement('option');
                    option.value = employee.id;
                    option.textContent = employee.name;
                    employeeSelect.appendChild(option);
                });
            })
            .catch(error => console.log(error));
    });
</script>
@endsection

