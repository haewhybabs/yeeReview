
@extends('layouts.main')
@section('content')
<div>
    <div class="page-title-area">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="breadcrumbs-area clearfix">
                    <ul class="breadcrumbs pull-left">
                        <li><a href="{{ URL::TO("dashboard") }}">Home</a></li>
                        <li><span>Performance Reviews</span></li>
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
                                {{-- <h4 class="header-title">All Performance Reviews</h4> --}}
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#filterReviews">
                                    Filter
                                </button>
                            </div>
                            @if(auth()->user()->role_id == env("ADMIN_ROLE") || auth()->user()->role_id==env("ORGANISATION_ROLE"))
                            <div class="col-6 text-right">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createReview">
                                    Create Review
                                </button>
                            </div>
                            @endif
                        </div><br>
                        <div class="data-tables">
                            <table id="dataTable" class="text-center">
                                <thead class="bg-light text-capitalize">
                                    <tr>
                                        <th>Employee Name</th>
                                        <th>Organisation</th>
                                        <th>Year</th>
                                        <th>Quarter</th>
                                        <th>Computed Rating </th>
                                        <th>View more</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reviews as $review)
                                    <tr>
                                        <td>{{ $review->employee?->user?->first_name }} {{ $review->employee?->user?->last_name }}</td>
                                        <td>{{ $review->organisation?->name }}</td>
                                        <td>{{ $review->year }}</td>
                                        <td>{{ $review->quarter->name }}</td>
                                        <td>{{ $review->computed_rating }} %</td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#view{{ $review->id }}">
                                                View
                                              </button>
                                        </td>
                                        
                                        <td></td>
                                        <td></td>
                                
                                    </tr>
                                    
                                      
                                      <!-- The Modal -->
                                      <div class="modal" id="view{{ $review->id }}">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                      
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                              <h4 class="modal-title">Performance Review Details</h4>
                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                      
                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <p>Employee Name: {{ $review->employee?->user?->first_name }} {{ $review->employee?->user->last_name }}</p>
                                                <p>Year: {{ $review->year }}</p>
                                                <p>Quarter: {{ $review->quarter->name }}</p>
                                                <p>Organisation: {{ $review->organisation->name }}</p>
                                                <p>National Id: {{ $review->national_id }}</p>
                                                <p>Computed Rating: {{ $review->computed_rating }}</p>
                                                <p>Reviewer Rating: {{ $review->reviewer_rating }}</p>
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
<div class="modal" id="createReview">
    <div class="modal-dialog">
      <div class="modal-content">
  
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Create Performance Review</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
  
        <!-- Modal body -->
        <div class="modal-body">
          <form method="POST" action="{{ URL::TO('create-review') }}">
            @csrf
            <h5>Performance Review Info</h5><br>
            <div class="row">
                <div class="form-group col-6">
                    <label>Comment</label>
                    <input type="text" class="form-control" name="organisation_comment" required />
                </div>
                <div class="form-group col-6">
                    <label>Reviewer Rating</label>
                    <select name="reviewer_rating" id="reviewer_rating" class="form-control">
                        @foreach ($ratings as $rating )
                            <option value="{{ $rating }}">{{ $rating }}</option>
                        @endforeach
                        
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-6">
                    <label>Year</label>
                    <input type="number" class="form-control" name="year" required  value="{{ date("Y") }}"/>
                </div>
                <div class="form-group col-6">
                    <label>Select Quarter</label>
                    <select  name="quarter_id" class="form-control">
                        @foreach ($quarters as $quarter )
                            <option value="{{ $quarter->id }}">{{ $quarter->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            
          
            
            @if($isAdmin)
                <div class="row">
                    
                    <div class="form-group col-6">
                        <label>Select Organisation</label>
                        <select name="organisation_id" id="organisation-select" class="form-control">
                            <option value="{{ 0 }}">Select Organisation</option>
                            @foreach ($organisations as $organisation )
                                <option value="{{ $organisation->id }}">{{ $organisation->name }}</option>
                            @endforeach
                            
                        </select>
                    </div>

                    <div class="form-group col-6">
                        <label>Select Employee</label>
                        <select name="employee_id" id="employee-select" class="form-control">
                            <!-- Options will be populated dynamically using JavaScript -->
                        </select>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-6">
                        <input type="hidden" name="organisation_id" value="{{ $organisation->id }}"/>
                        <div class="form-group">
                            
                            <select name="employee_id" class="form-control">
                                <option value="0">Select Employee</option>
                                @foreach ($employees as $employee )
                                    <option value="{{ $employee->id }}">{{ $employee->user->first_name}} {{ $employee->user->last_name }}</option>
                                @endforeach
                                <!-- Options will be populated dynamically using JavaScript -->
                            </select>
                        </div>
                    </div>
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



<div class="modal" id="filterReviews">
    <div class="modal-dialog">
      <div class="modal-content">
  
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Filter Performance Review</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
  
        <!-- Modal body -->
        <div class="modal-body">
          <form method="GET" action="{{ URL::TO('performance-reviews') }}">
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
            

            <div class="form-group">
                <label>Filter by National Id</label>
                <input type="text" class="form-control" name="national_id" id="national_id"/>
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


    document.addEventListener("DOMContentLoaded", function () {
    // Initially hide the organisation and employee fields
        var organisationField = document.getElementById("organisation-field");
        var employeeField = document.getElementById("employee-field");

        // organisationField.style.display = "none";
        // employeeField.style.display = "none";

        // Listen for changes in the national_id input
        var nationalIdInput = document.getElementById("national_id");
        nationalIdInput.addEventListener("input", function () {
            if (nationalIdInput.value) {
                // If national_id has a value, hide organisation and employee fields
                organisationField.style.display = "none";
                employeeField.style.display = "none";
            } else {
                // If national_id is empty, show organisation and employee fields
                organisationField.style.display = "block";
                employeeField.style.display = "block";
            }
        });
    });
</script>
@endsection

