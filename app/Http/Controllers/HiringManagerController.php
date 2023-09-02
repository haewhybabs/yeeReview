<?php

namespace App\Http\Controllers;

use App\Models\HiringManager;
use App\Services\HiringManagerService;
use App\Services\OrganisationService;
use App\Services\UserService;
use Illuminate\Http\Request;

class HiringManagerController extends Controller
{
    protected $userService;
    protected $organisationService;
    protected $hiringManagerService;

    public function __construct(UserService $userService, OrganisationService $organisationService,HiringManagerService $hiringManagerService)
    {
        $this->userService = $userService;
        $this->organisationService = $organisationService;
        $this->hiringManagerService = $hiringManagerService;
    }

    public function create(Request $request){
        $role = env("HIRING_MANAGER_ROLE");
        $user = $this->userService->createUserOthers($request,$role);

        $hiringData = [
            'organisation_id'=>$request->organisation_id,
            'user_id'=>$user->id,
            'description'=>$request->description,
            'department'=>$request->department,
            'status'=>'approved',
        ];
        $this->hiringManagerService->create($hiringData);
        return redirect()->back()->with(['alert-type'=>'success','message'=>'Hiring Manager has been successfully created']);
    }

    public function delete($id){
        $this->userService->deleteUser($id);
        $hiringManager = $this->hiringManagerService->findByUserId($id);
        $this->hiringManagerService->deleteHiringManager($hiringManager->id);
        return redirect()->back()->with(['alert-type'=>'success','message'=>'Hiring Manager has been successfully deleted']);
    }
}
