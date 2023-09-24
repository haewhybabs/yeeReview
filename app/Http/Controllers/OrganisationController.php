<?php

namespace App\Http\Controllers;

use App\Services\EmployeeService;
use App\Services\OrganisationService;
use App\Services\UserService;
use Illuminate\Http\Request;

class OrganisationController extends Controller
{
    protected $userService;
    protected $organisationService;
    protected $employeeService;

    public function __construct(UserService $userService, OrganisationService $organisationService, EmployeeService $employeeService)
    {
        $this->userService = $userService;
        $this->organisationService = $organisationService;
        $this->employeeService = $employeeService;
    }


    public function list(){
        $organisations = $this->organisationService->findAll();
        return view('organisations.list',compact('organisations'));
    }

    public function updateOrganisationStatus(Request $request){
        $organisationId = $request->organisation_id;
        $update = $this->organisationService->update(['status'=>$request->type],$organisationId);
        if($update){
            return redirect()->back()->with(['alert-type'=>'success','message'=>'Organisation has been successfully updated']);
        }

        return redirect()->back()->with(['alert-type'=>'error','message'=>'Error occured']);
        
    }

    public function employeeOrganisationList(){
        $user = auth()->user();
        $nationalId = $user->employee->national_id;
        $organisations = $this->organisationService->findByNationalId($nationalId);
        return view('organisations.employeeList',compact('organisations'));

    }
}
