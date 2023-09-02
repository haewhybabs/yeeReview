<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Services\EmployeeService;
use App\Services\OrganisationService;
use App\Services\UserService;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    protected $userService;
    protected $organisationService;
    protected $employeeService;

    public function __construct(UserService $userService, OrganisationService $organisationService,EmployeeService $employeeService)
    {
        $this->userService = $userService;
        $this->organisationService = $organisationService;
        $this->employeeService = $employeeService;
    }

    public function list(){
        $employees = $this->employeeService->findAll();
        $departments = Department::all();
        $status='approve';
        $organisations = $this->organisationService->findByStatus($status);
        return view('employees.list',compact('employees','departments','organisations'));
    }

    public function create(Request $request){
        $role = env("EMPLOYEE_ROLE");
        $user = $this->userService->createUserOthers($request,$role);
        $data = $request->validate([
            'current_organisation_id'=>'required',
            'address'=>'required',
            'dob'=>'required',
            'phone_number'=>'required',
            'marital_status'=>'required',
            'national_id'=>'required',
            'position'=>'required',
            'department_id'=>'required'
        ]);
        $savedUser = $this->userService->findByEmail($request->email);
        $data['user_id']=$savedUser->id;
        $saveEmployee = $this->employeeService->create($data);
        return redirect('/employees')->with(['alert-type'=>'success', 'message'=>'Employee has been successfully created']);

        
    }
    
}
