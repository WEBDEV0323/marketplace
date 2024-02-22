<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Session;
use Auth;
use App\Models\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /* public function __construct()
    {
        $this->middleware('guest')->except('logout');
    } */
    public function noAccess(){
        echo "<h2>no access please</h2>";
    }

    public function loginProcess(Request $request)
    {

        if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])){
            return redirect(route('admin.dashboard'));
        
        }
        else if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password,'flags'=>1, 'emailVerify'=>1]))
        { 
            
            return redirect(route('update_account'));
        }
        else
        {

            $userdata = User::where('email',$request->email)->where('emailVerify',0)->first();
            if($userdata){
                return \Redirect::route('login.login')->with('message_error_verified', 'Please verify your account via email. Resend verification email')->with('mail_resend_get', $request->email);
            }
            $lost='"Lost your password?"';
            return \Redirect::back()->with("error","Oops! You've entered an incorrect email address or password. Please try again or get a new password by clicking on ".$lost);
        }
        // if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])){
        //     return redirect(route('admin.dashboard'));
        
        // }
        // else if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password,'flags'=>1]))
        // { 
            
        //     if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password,'emailVerify'=>1]))
        //     {
        //         return redirect(route('update_account'));    
        //     }
        //     else
        //     {
        //         return \Redirect::back()->with("error","Oops! Your email is not verify please verify your email");    
        //     }
        // }
        // else
        // {
        //     $lost='"Lost your password?"';
        //     return \Redirect::back()->with("error","Oops! You've entered an incorrect email address or password. Please try again or get a new password by clicking on ".$lost);
        // }
      
    }

    public function login(){
        return view('auth.login');
    }
}
