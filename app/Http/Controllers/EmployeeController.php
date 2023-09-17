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
        $user = auth()->user();
        $isAdmin = true;
        $employees = $this->employeeService->findAll();
        $departments = Department::all();
        $status='approve';
        $organisation=null;
        $organisations = $this->organisationService->findByStatus($status);
        if($user?->role->id ==env("ORGANISATION_ROLE") || $user?->role->id == env("HIRING_MANAGER_ROLE")){
            $isAdmin = false;
            if($user?->role->id==env("HIRING_MANAGER_ROLE")){
                $employees = $this->employeeService->findByOrganisation($user->hiringManager->organisation_id);
                $organisation = $this->organisationService->findById($user->hiringManager->organisation_id);
            }
            else{
                $employees = $this->employeeService->findByOrganisation($user->organisation->id);
                $organisation = $this->organisationService->findById($user->organisation->id);
            }
            
        }
        return view('employees.list',compact('employees','departments','organisations','organisation','isAdmin'));
    }

    public function createEmployee(Request $request){
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
        $data['bio']=$request->bio;
        $saveEmployee = $this->employeeService->create($data);
        return redirect('/employees')->with(['alert-type'=>'success', 'message'=>'Employee has been successfully created']);

        
    }
    public function getEmployees($organisationId){
        $employees = $this->employeeService->findByOrganisation($organisationId);
        $data = array();
        foreach ($employees as $employee) {
            $employeeData = array();
            $employeeData['name'] = $employee->user->first_name . ' ' . $employee->user->last_name;
            $employeeData['id'] = $employee->id;
            $data[] = $employeeData;
        }
        return response()->json($data);
    }
    
}
