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

    public function list(){
        $user = auth()->user();
        $isAdmin = true;
        $hiringManagers = $this->hiringManagerService->findAll();
        $status='approve';
        $organisations = $this->organisationService->findByStatus($status);
        $organisation = null;
        if($user?->role->id ==env("ORGANISATION_ROLE")){
            $isAdmin = false;
            $hiringManagers = $this->hiringManagerService->findByOrganisation($user->organisation->id);
            $organisation = $this->organisationService->findById($user->organisation->id);
        }
       
        return view('hiringManager.list',compact('hiringManagers',"organisations","isAdmin","organisation"));
    }

    public function createHiringManager(Request $request){
        $role = env("HIRING_MANAGER_ROLE");
        $user = $this->userService->createUserOthers($request,$role);

        $hiringData = [
            'organisation_id'=>$request->organisation_id,
            'user_id'=>$user->id,
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

    public function hiringView(){
        $user = auth()->user();
        $hiringManager = $this->hiringManagerService->findByUserId($user->id);
        $status='approve';
        $organisations = $this->organisationService->findByStatus($status);
        $organisation = $this->organisationService->findById($hiringManager->organisation_id);

        return view('hiringManager.hiring_view',compact('hiringManager',"organisations","organisation"));
    }

    public function updateHiringManager(Request $request){
        $data = array(
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name
        );
        $id = auth()->user()->id;
        $update = $this->userService->updateUser($data,$id);

        return redirect()->back()->with(['alert-type'=>'success','message'=>'Updated successfully']);
    }
}
