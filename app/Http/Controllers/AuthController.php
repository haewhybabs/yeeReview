<?php

namespace App\Http\Controllers;
use App\Services\UserService;
use App\Services\OrganisationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    protected $userService;
    protected $organisationService;

    public function __construct(UserService $userService, OrganisationService $organisationService)
    {
        $this->userService = $userService;
        $this->organisationService = $organisationService;
    }

    public function index(){
        return view('auth.login');
    }

    public function handleLogin(Request $request){
        $login = $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);
        $response = [
            'message'=>'Invalid login details',
            'alert-type'=>'error'
        ];
        $user = $this->userService->findByEmail($request->email);
        if($user){
            if(Auth::attempt($login)){
               return redirect('/dashboard');
            }
        }
        return redirect()->back()->with($response);
    }

    public function organisationSignup(){
        return view('auth.register');
    }
    public function handleOrganisationSignup(Request $request){
        $register = $request->validate([
            'password' => 'required|min:8|confirmed',
            'email'=>'required|email|unique:users',
            'first_name'=>'required',
            'last_name'=>'required',
            'password'
        ]);
        $register['role_id']=env('ORGANISATION_ROLE');
        $register['password']=bcrypt($request->password);

        $user = $this->userService->create($register);
        $login = [
            'email'=>$request->email,
            'password'=>$request->password
        ];
       
        if($user){
            if(Auth::attempt($login)){
                return view('auth.register2');
            }
        }
        return redirect()->back()->with(['alert-type'=>'error','message'=>'Unable to initiate your registration']);

    
    }
    public function handleOrganisationSignup2(Request $request){
        $data = $request->validate([
            'email'=>'required|email|unique:organisations',
            'name'=>'required',
            'address'=>'required',
            'description'=>'required',
            'phone_number'=>'required',
            'industry'=>'required',
            'website'=>'required'
        ]);
        $data['user_id'] = auth()->user()->id;
        $data['status']= 'pending';
        $organisation = $this->organisationService->create($data);
        
        if($organisation){
            return redirect('/dashboard');
        }

    }

    

    public function register(){

        return view('login.register');
    }
   
    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}