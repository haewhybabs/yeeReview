<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use App\Models\Quarter;
use App\Services\EmployeeService;
use App\Services\GoalService;
use App\Services\OrganisationService;
use App\Services\UserService;
use Illuminate\Http\Request;

class GoalController extends Controller
{
    protected $userService;
    protected $organisationService;
    protected $employeeService;
    protected $goalService;

    public function __construct(UserService $userService, OrganisationService $organisationService,EmployeeService $employeeService,GoalService $goalService)
    {
        $this->userService = $userService;
        $this->organisationService = $organisationService;
        $this->employeeService = $employeeService;
        $this->goalService = $goalService;
    }

    public function list(Request $request){
        $user = auth()->user();
        $isAdmin = true;
        $employees =[];
        $employeeId = $request->query('employee_id');
        $organisationId = $request->query('organisation_id');
        $organisation=null;
        $employees=[];
        if($user?->role->id ==env("ORGANISATION_ROLE")){
            $isAdmin = false;
            $employees = $this->employeeService->findByOrganisation($user->organisation->id);
            $organisation = $this->organisationService->findById($user->organisation->id);
            $organisationId = $organisation->id;
        }
        $goals = $this->goalService->filterGoals($employeeId,$organisationId);
        $status='approve';
        $organisations = $this->organisationService->findByStatus($status);
        $quarters = Quarter::all();
        
        // $employeeGoals = $this->goalService->findByEmployeeId($employeeId);
        // $organisationGoals = $this->goalService->findByOrganisationId($organisationId);
        return view('goals.list',compact('goals','organisations','quarters','isAdmin','organisation','employees'));
    }
    public function createGoal(Request $request){
        $data = $request->validate([
            'employee_id'=>'required',
            'organisation_id'=>'required',
            'description'=>'required',
            'goal_name'=>'required',
            'year'=>'required',
            'quarter_id'=>'required',
            'expected_days'=>'required',
            'delivered_days'=>'required',
            'weight'=>'required',
            'status'=>'required'
        ]);

        $data['completed_on_time'] = $request->expected_days <= $request->delivered_days ? true:false;

        $goal = $this->goalService->create($data);

        return redirect('/goals')->with(['alert-type'=>'success','message'=>'Goal has been successfully created']);

        // return redirect()->back()->with(['alert-type'=>'success','message'=>'Goal has been successfully created']);

    }

    public function employeeList(Request $request){
        $user = auth()->user();
        $employeeId = $user->employee->id;
        $organisationId = $user->employee->current_organisation_id;
        $goals = $this->goalService->findByEmployeeId($employeeId);
        $organisation = $this->organisationService->findById($organisationId);
        $isAdmin = false;
        $employees = [];
        $organisations = [];
        $quarters = Quarter::all();
        return view('goals.employeeList',compact('goals','organisations','quarters','isAdmin','organisation','employees'));
    }

  
    
}
