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
                        <h4 class="header-title">All organisations</h4>
                        <div class="data-tables">
                            <table id="dataTable" class="text-center">
                                <thead class="bg-light text-capitalize">
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Industry</th>
                                        <!-- <th>Action</th> -->
                                        <!-- <th>Status</th> -->
                                        <th>Phone number</th>
                                        <th></th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($organisations as $organisation)
                                    <tr>
                                        <td>{{ $organisation->name }}</td>
                                        <td>{{ $organisation->email }}</td>
                                        <td>{{ $organisation->industry }}</td>
                                        {{-- <td>
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#list{{ $organisation->id }}">
                                                View
                                              </button>
                                        </td>
                                        
                                        <td>{{ $organisation->status }}</td> --}}
                                        <td>{{ $organisation->phone_number }}</td>
                                        <td></td>
                                    </tr>
                                    
                                      
                                      <!-- The Modal -->
                                      <div class="modal" id="list{{ $organisation->id }}">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                      
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                              <h4 class="modal-title">Organisation Details</h4>
                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                      
                                            <!-- Modal body -->
                                            <div class="modal-body">
                                              <p>Name: {{ $organisation->name }}</p>
                                              <p>Description: {{ $organisation->description }}</p>
                                              <p>Email: {{ $organisation->email }}</p>
                                              <p>Address: {{ $organisation->address }}</p>
                                              <p>Phone number: {{ $organisation->phone_number }}</p>
                                              <p>Industry: {{ $organisation->industry }}</p>
                                              <p>Website: {{ $organisation->website }}</p>
                                              <p>status: {{ $organisation->status }}</p>

                                              <hr/>
                                                <h4>Account Holder </h4>
                                                <p>Email : {{ $organisation->user?->email }}</p>
                                                <p>Name : {{ $organisation->user?->first_name }}  {{ $organisation->user?->last_name }}</p>
                                              <hr/>
                                                <h4>Update Status</h4><br>
                                                <div class="row">
                                                    <form action="{{ URL::TO('update-organisation-status') }}" method="POST" class="margin-align">
                                                        @csrf
                                                        <input type="hidden" name="type" value="approve" />
                                                        <input type="hidden" name="organisation_id" value="{{ $organisation->id }}"/>
                                                        <button type="submit" class="btn btn-primary"> Approve </button>
                                                    </form>

                                                    <form action="{{ URL::TO('update-organisation-status') }}" method="POST" class="margin-align">
                                                        @csrf
                                                        <input type="hidden" name="type" value="reject" />
                                                        <input type="hidden" name="organisation_id" value="{{ $organisation->id }}"/>
                                                        <button type="submit" class="btn btn-danger"> Reject </button>
                                                    </form>
                                                </div>
                                            
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
@endsection