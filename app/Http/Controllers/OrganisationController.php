<?php

namespace App\Http\Controllers;

use App\Services\OrganisationService;
use App\Services\UserService;
use Illuminate\Http\Request;

class OrganisationController extends Controller
{
    protected $userService;
    protected $organisationService;

    public function __construct(UserService $userService, OrganisationService $organisationService)
    {
        $this->userService = $userService;
        $this->organisationService = $organisationService;
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
}
