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

    public function list(){
        $user = auth()->user();
        $isAdmin = true;
        $recruitments = $this->recruitmentService->findAll();
        $organisations = $this->organisationService->findAll();
        $organisation=null;
        
        if($user?->role->id ==env("ORGANISATION_ROLE") || $user?->role->id == env("HIRING_MANAGER_ROLE")){
            $isAdmin = false;
            if($user?->role->id==env("HIRING_MANAGER_ROLE")){
               
                $recruitments = $this->recruitmentService->findByOrganisation($user->hiringManager->organisation_id);
                $organisation = $this->organisationService->findById($user->hiringManager->organisation_id);
                
            }
            else{
                $recruitments = $this->recruitmentService->findByOrganisation($user->organisation->id);
                $organisation = $this->organisationService->findById($user->organisation->id);
            }
            
        }
        return view('recruitments.list',compact('recruitments','organisations','organisation','isAdmin'));
    }

    public function create(Request $request){
        $data = $request->validate(['national_id'=>'required']);
        $userId = auth()->user()->id;
        // $data['organisation_id'] =
        // $data['decision_status']='pending';
        
    }
}
