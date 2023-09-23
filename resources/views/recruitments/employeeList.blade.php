@extends('layouts.main')
@section('content')
<div>
    <div class="page-title-area">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="breadcrumbs-area clearfix">
                    <ul class="breadcrumbs pull-left">
                        <li><a href="{{ URL::TO("dashboard") }}">Home</a></li>
                        <li><span>Recruitments</span></li>
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
                                <h4 class="header-title">All Recruitments</h4>
                            </div>
                           
                        </div><br>
                        <div class="data-tables">
                            <table id="dataTable" class="text-center">
                                <thead class="bg-light text-capitalize">
                                    <tr>
                                        <th>Employee Name</th>
                                        <th>National ID</th>
                                        <th>Organisation</th>
                                        <th>Status</th>
                                        <th>View Reviews </th>
                                        {{-- <th>Action</th> --}}
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($recruitments as $recruitment)
                                    <tr>
                                        <td>{{ $recruitment->candidate_name}}</td>
                                        <td>{{ $recruitment->national_id }}</td>
                                        <td>{{ $recruitment->organisation?->name }}</td>
                                        <td>{{ $recruitment->decision_status }}</td>
                                        <td>
                                            <a href="{{ URL::TO("performance-reviews") }}?national_id={{ $recruitment->national_id }}" class="btn btn-primary">View</a>
                                        </td>
                                        {{-- <td>
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#action{{ $recruitment->id }}">
                                                View
                                              </button>
                                        </td> --}}
                                        
                                        <td></td>
                                        <td></td>
                                
                                    </tr>
                                    
                                      
                                      <!-- The Modal -->
                                      <div class="modal" id="view{{ $recruitment->id }}">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                      
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                              <h4 class="modal-title">Performance Review Details</h4>
                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                      
                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <p>Employee Name: {{ $recruitment?->candidate_name }}</p>
                                                <p>National ID: {{ $recruitment->national_id }}</p>
                                                <p>Organisation: {{ $recruitment?->organisation->name }}</p>
                                                <p>National Id: {{ $recruitment?->national_id }}</p>
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

