<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use App\Models\PerformanceReview;
use App\Services\EmployeeService;
use App\Services\GoalService;
use App\Services\HiringManagerService;
use App\Services\OrganisationService;
use App\Services\PerformanceReviewService;
use App\Services\RecruitmentService;
use App\Services\UserService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $userService;
    protected $organisationService;
    protected $employeeService;
    protected $goalService;
    protected $hiringMangerService;
    protected $performanceReviewService;
    protected $recruitmentService;
    public function __construct(UserService $userService, OrganisationService $organisationService,EmployeeService $employeeService,GoalService $goalService,HiringManagerService $hiringManagerService,PerformanceReviewService $performanceReviewService,RecruitmentService $recruitmentService)
    {
        $this->userService = $userService;
        $this->organisationService = $organisationService;
        $this->employeeService = $employeeService;
        $this->goalService = $goalService;
        $this->hiringMangerService = $hiringManagerService;
        $this->performanceReviewService = $performanceReviewService;
        $this->recruitmentService = $recruitmentService;
    }
    
    public function index(){
        $user = auth()->user();
       
        if($user->role_id == env("ORGANISATION_ROLE")){
            $id = $user->organisation->id;
            $goals = count($this->goalService->findByOrganisationId($id));
            $employees = count( $this->employeeService->findByOrganisation($id));
            $hiringManagers =  count($this->hiringMangerService->findByOrganisation($id));
            $performances = count($this->performanceReviewService->findByOrganisationId($id));
            return view('dashboards.organisation',compact('goals','employees','hiringManagers','performances'));
        }
        if($user->role_id==env("EMPLOYEE_ROLE")){
            $id = $user->employee->id;
            $goals = count($this->goalService->findByOrganisationId($id));
            $performances = count($this->performanceReviewService->findByOrganisationId($id));
            $nationalId = $user->employee->national_id;
            $organisations = count($this->organisationService->findByNationalId($nationalId));
            $status = "completed";
            $completedGoals = count($this->goalService->findByEmployeeIdAndStatus($id,$status));
            return view('dashboards.employee',compact('goals','performances','completedGoals','organisations'));
        }

        if($user->role_id==env("HIRING_MANAGER_ROLE")){
            $id = $user->hiringManager->organisation_id;
            $hiringmangerId = $user->hiringManager->id;
            
            $employees = count( $this->employeeService->findByOrganisation($id));
            $performances = count($this->performanceReviewService->findByOrganisationId($id));
            $recruitments = count($this->recruitmentService->findByOrganisation($id));
            $goals = count($this->goalService->findByOrganisationId($id));
            return view('dashboards.hiringManager',compact('performances','recruitments','employees','goals'));
        }
        if($user->role_id == env("ADMIN_ROLE")){           
            $employees = count( $this->employeeService->findAll());
            $performances = count($this->performanceReviewService->findAll());
            $recruitments = count($this->recruitmentService->findAll());
            $organisations = count($this->organisationService->findAll());
            return view('dashboards.admin',compact('employees','performances','recruitments','organisations'));
        }
        
       
    }
}
