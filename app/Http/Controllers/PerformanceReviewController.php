<?php

namespace App\Http\Controllers;

use App\Models\Quarter;
use App\Services\EmployeeService;
use App\Services\GoalService;
use App\Services\OrganisationService;
use App\Services\PerformanceReviewService;
use App\Services\UserService;
use DateTime;
use Illuminate\Http\Request;

class PerformanceReviewController extends Controller
{
    protected $userService;
    protected $organisationService;
    protected $employeeService;
    protected $goalService;
    protected $performanceReviewService;

    public function __construct(UserService $userService, OrganisationService $organisationService,EmployeeService $employeeService,GoalService $goalService,PerformanceReviewService $performanceReviewService)
    {
        $this->userService = $userService;
        $this->organisationService = $organisationService;
        $this->employeeService = $employeeService;
        $this->goalService = $goalService;
        $this->performanceReviewService = $performanceReviewService;
    }

    public function list(Request $request){
        $user = auth()->user();
        $isAdmin = true;
        $employeeId = $request->query('employee_id');
        $organisationId = $request->query('organisation_id');
        $nationalId = $request->query('national_id');
        $organisation=null;
        $employees = [];
        if($user?->role->id ==env("ORGANISATION_ROLE") || $user?->role->id ==env("HIRING_MANAGER_ROLE")){
            $isAdmin = false;
            if($user?->role->id==env("HIRING_MANAGER_ROLE")){
                $employees = $this->employeeService->findByOrganisation($user->hiringManager->organisation_id);
                $organisation = $this->organisationService->findById($user->hiringManager->organisation_id);
            }
            else{
                $employees = $this->employeeService->findByOrganisation($user->organisation->id);
                $organisation = $this->organisationService->findById($user->organisation->id);
            }
            
            $organisationId = $organisation->id;
        }
        $reviews = $this->performanceReviewService->filterPerformanceReviews($employeeId,$organisationId,$nationalId);
        $status='approve';
        $organisations = $this->organisationService->findByStatus($status);
        $quarters = Quarter::all();
        $ratings = ['Excellent - A','Satisfactory - B','Average -C','Poor -D','Very Poor - E', 'Failed - F'];
        return view('reviews.list',compact('reviews','organisations','quarters','ratings','organisation','isAdmin','employees'));
    }
    public function createReview(Request $request){
        $data = $request->validate([
            'employee_id'=>'required',
            'organisation_id'=>'required',
            'reviewer_rating'=>'required',
            'year'=>'required',
            'quarter_id'=>'required',
            'organisation_comment'=>'required',
        ]);

        $employee = $this->employeeService->findById($request->employee_id);

        //calculate the employee rating 
        $score = $this->performanceReviewService->calculatePerformanceScore($data);
        $data['computed_rating'] = $score ? $score : 0;
        $date = new DateTime();
        $data['review_date']=$date->format('Y-m-d H:i:s');
        $data['national_id'] = $employee->national_id;
        
        $checkReview = $this->performanceReviewService->fetchReviewByDetails($data);
        if($checkReview){
            $updatedData = array(
                'computed_rating'=>$data['computed_rating'],
                'review_data'=>$data['review_date'],
                'comment'=>$data['comment']
            );
            $this->performanceReviewService->update($updatedData,$checkReview->id);
        }
        else{
            $this->performanceReviewService->create($data);
        }
        

        return redirect()->back()->with(['alert-type'=>'success','message'=>'Review has been successfully created']);

    }
    public function employeePerformanceList(){
        $user = auth()->user();
        $employeeId = $user->employee->id;
        $organisationId=null;
        $nationalId = null;
        $reviews = $this->performanceReviewService->filterPerformanceReviews($employeeId,$organisationId,$nationalId);

        $ratings = ['Excellent - A','Satisfactory - B','Average -C','Poor -D','Very Poor - E', 'Failed - F'];
        return view('reviews.employeeList',compact('reviews','ratings'));
    }
    public function handleSelfReview(Request $request){
        $validatedData = $request->validate([
            'employee_comment'=>'required',
            'self_review'=>"required",
        ]);
        $data = array(
            'employee_comment'=>$request->employee_comment,
            'self_review'=>$request->self_review
        );
        $update = $this->performanceReviewService->updatePerformanceReview($data,$request->review_id);
        return redirect()->back()->with(['alert-type'=>'success','message'=>'Self review has been successfully created']);
        
    }
}
