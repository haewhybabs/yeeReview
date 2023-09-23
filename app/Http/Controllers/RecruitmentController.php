<?php

namespace App\Http\Controllers;

use App\Services\OrganisationService;
use App\Services\RecruitmentService;
use App\Services\UserService;
use Illuminate\Http\Request;

class RecruitmentController extends Controller
{
    protected $userService;
    protected $organisationService;
    protected $recruitmentService;

    public function __construct(UserService $userService, OrganisationService $organisationService,RecruitmentService $recruitmentService)
    {
        $this->userService = $userService;
        $this->organisationService = $organisationService;
        $this->recruitmentService = $recruitmentService;
    }

    public function list(Request $request){
        $user = auth()->user();
        $isAdmin = true;
        $recruitments = $this->recruitmentService->filterRecruitments($request->national_id,$request->organisation_id);
        $organisations = $this->organisationService->findAll();
        $organisation=null;
        
        if($user?->role->id ==env("ORGANISATION_ROLE") || $user?->role->id == env("HIRING_MANAGER_ROLE")){
            $isAdmin = false;
            if($user?->role->id==env("HIRING_MANAGER_ROLE")){
               
                // $recruitments = $this->recruitmentService->filterRecruitments($request->national_id,$user->hiringManager->organisation_id);
                $organisation = $this->organisationService->findById($user->hiringManager->organisation_id);
                
            }
            else{
                // $recruitments = $this->recruitmentService->filterRecruitments($request->national_id,$user->organisation->id,);
                $organisation = $this->organisationService->findById($user->organisation->id);
            }
            
        }
        return view('recruitments.list',compact('recruitments','organisations','organisation','isAdmin'));
    }

    public function create(Request $request){
        $data = $request->validate(['national_id'=>'required','candidate_name'=>'required']);
        $user = auth()->user();
        $data['decision_status']='review';
        $data['hiring_manager_id'] = $user->hiringManager->id;
        $data['organisation_id'] = $user->hiringManager->organisation_id;

        $create = $this->recruitmentService->create($data);
        return redirect()->back()->with(['alert-type'=>'success','message'=>'Recruitment created successfullu']);

        // $data['organisation_id'] =
        // $data['decision_status']='pending';
        
    }
    public function updateRecruitmentStatus(Request $request){
        $id = $request->recruitmentId;
        $data = array(
            'decision_status'=>$request->status,
        );
        $update = $this->recruitmentService->updateRecruitment($data,$id);
        return redirect()->back()->with(['alert-type'=>'success','message'=>'Recruitment status updated successfully']);
    }
    public function employeeRecruitmentList(){
        $user = auth()->user();
        $nationalId = $user->employee->national_id;
        $recruitments = $this->recruitmentService->findByNationalId($nationalId);

        return view('recruitments.employeeList',compact('recruitments'));
    }
}
