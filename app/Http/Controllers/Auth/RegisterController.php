<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Mail\accountSignupAlert;
use Auth;
use Illuminate\Support\Str;
use Redirect;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendSignUpMail;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */

    public function verifyemail()
    {
        return view('verifyemail');
    }

    public function verification($code)
    {
        $user = User::query()->where('emailCode', '=', $code)->first();
        if ($user) {
            $update['emailVerify'] = 1;
            User::query()->where('emailCode', '=', $code)->update($update);
           
        }else{
            return redirect()->route('login.login')->with('message', 'Invalid verification link.');
         }
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    // public function registerProcess(Request $request)
    // {
    //     $request->validate([
    //         'first_name'  => 'required|string',
    //         'last_name'  => 'required|string',
    //         'phone'  => 'required|string',
    //         'email' => 'required|email|unique:users',
    //         'password' => [
    //             'required',
    //             'string',
    //         ],
    //         'confirm_password'=>'required|same:password',
    //     ]);

    //     $user = new User();
    //     $user->first_name = $request->first_name;
    //     $user->last_name = $request->last_name;
    //     $user->email = $request->email;
    //     $user->password = Hash::make($request->password);
    //     $user->phone = (!empty($request->phone) ? $request->phone : null);
    //     $user->gender = (!empty($request->gender) ? $request->gender : null);
    //     if($request->user_type == 1)
    //     {
    //         $user->user_type = "1";
    //     }
    //     else
    //     {
    //         $user->user_type = "2";
    //     }
    //     $user->flags = 1;
    //     $emailCode = rand(1000,9999);
    //     $mail = $request->email;
    //     $data['username']=$request->first_name;
    //     $data['emailCode']=$emailCode;
    //     $data['link'] = "https://keshavinfotechdemo2.com/keshav/KG2/HARR/public/verification/".$emailCode;

    //     Mail::send('auth.verifyemail', $data,function($message) use($mail){
    //         $message->from('noreplay@keshavinfotechdemo2.com', 'HARR');
    //         $message->to($mail)->subject('Verify Your Email');
    //     });

    //     $user->emailCode = $emailCode;
    //     if($user->save())
    //     {           

    //         if (!is_dir(storage_path("app/public/user/"))) 
    //         {
    //             mkdir(storage_path("app/public/user/"), 0777, true);
    //         }
    //         if (!is_dir(storage_path("app/public/user/" .$user->id))) 
    //         {
    //             mkdir(storage_path("app/public/user/" .$user->id), 0777, true);
    //         }
    //         if(\File::exists($request->image))
    //         {
    //             $file_name = addFile($request->image, storage_path("app/public/user/" . $user->id));
    //             $user->image_url = $file_name;

    //             $user->save();
    //         }

    //         $artisan_call_to_make_files_public = \Artisan::call("storage:link", []);
    //         if ($artisan_call_to_make_files_public) 
    //         {
    //             DB::rollBack();
    //         }

    //         return redirect()->back()->with('message', 'Please check your emails to activate your account');
    //     }
    // }

    public function registerProcess(Request $request)
    {
        $request->validate([
            'first_name'  => 'required|string',
            'last_name'  => 'required|string',
            'phone'  => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => ['required','string',],
            'confirm_password' => 'required|same:password',

        ]);

        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone = (!empty($request->phone) ? $request->phone : null);
        $user->gender = (!empty($request->gender) ? $request->gender : null);
        //$user->addFlag(User::FLAG_ACTIVE);
        $token = Str::random(64);
        $user->email_verification_token =  $token;
        if($request->has('created_by')){
            $user->emailVerify = 1;
            $user->coupon_code = $request->coupon_code??null;
        }

        if ($request->user_type == 1) {
            $user->user_type = "1";
            $user->affiliate_status = "0";
            $nameOfUser = "Seller";
        } elseif ($request->user_type == 3) {
            $user->user_type = "1";
            $user->affiliate_status = "1";
            $nameOfUser = "Affiliate";
            $user->tier_type = $request->commission_setting;
        }else {
            $user->user_type = "2";
            $user->affiliate_status = "0";
            $nameOfUser = "User";
        }
        $user->flags = 1;
        $name = $request->first_name . " " . $request->last_name;
        $email = $request->email;
        $phone = $request->phone;
        Mail::to($email)->send(new SendSignUpMail($name, $email, $phone));

        if ($user->save()) {
            if (!is_dir(storage_path("app/public/user/"))) {
                mkdir(storage_path("app/public/user/"), 0777, true);
            }
            if (!is_dir(storage_path("app/public/user/" . $user->id))) {
                mkdir(storage_path("app/public/user/" . $user->id), 0777, true);
            }
            if (\File::exists($request->image)) {
                $file_name = addFile($request->image, storage_path("app/public/user/" . $user->id));
                $user->image_url = $file_name;

                $user->save();
            }




            $artisan_call_to_make_files_public = \Artisan::call("storage:link", []);
            if ($artisan_call_to_make_files_public) {
                DB::rollBack();
            }

            if($request->has('created_by')){
                return back()->with(['message' => $nameOfUser." Register Successfully"]);
            }else{
                $emailis = $request->email;
                try {
                    Mail::send('auth.emailVerificationEmail', ['emailis' => $emailis, 'token' => $token], function ($message) use ($emailis) {
                        $message->to($emailis);
                        $message->subject('Email Verification Mail');
                    });
                    return redirect()->route('resend_verification_page.email')->with('mail_resend_get', $request->email);
                } catch (\Exception $e) {
                    // Do nothing 
                    return redirect()->back()->with('success', '');
                }
            }

            // return redirect()->back()->with('success', 'your message,here');

            // if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password,'flags'=>1]))
            // {

            //     return redirect(route('update_account'));
            // }
        }
        //return back()->with(['message' => "User Register Successfully"]);
    }



    public function userVerifyMail(Request $request)
    {
        $userdata = User::where('email', $request->email)->where('email_verification_token', $request->token)->first();
        if ($userdata) {
            $userdata->emailVerify = 1;
            $userdata->email_verification_token = '';
            $userdata->save();
            Mail::to(config('constants.admin_email'))->send(new accountSignupAlert($userdata));
            return Redirect::route('login.login')->with('message_success_verified', 'You are successfully verified.');
        }
        return Redirect::route('login.login');
    }
    public function userResendVerifyMailpage(Request $request)
    {
        return view('auth.emailVerification');
    }
    public function userVerifyMailMessage(Request $request)
    {
        return view('auth.emailVerificationMessage');
    }
    public function userResendVerifyMail(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email'],
        ]);

        $userdata = User::where('email', $request->email)->first();
        if ($userdata) {
            if ($userdata->emailVerify == 1) {
                return back()->with('status_already', 'Email already verified.');
            } else {
                $token = Str::random(64);
                $emailis = $userdata->email;
                $userdata->email_verification_token = $token;
                $userdata->save();
                try {
                    Mail::send('auth.emailVerificationEmail', ['emailis' => $emailis, 'token' => $token], function ($message) use ($emailis) {
                        $message->to($emailis);
                        $message->subject('Email Verification Mail');
                    });
                } catch (\Exception $e) {
                    // Do nothing 
                }
                // return back()->with('status_email_send', 'We have  send you Email Verification instruction on your Email please check you email. If you did not receive the email You can resend.');
                return back()->with('message_error_verified', 'Please verify your account via email. Resend verification email')->with('mail_resend_get', $request->email);
            }
        } else {
            return back()->with('status_email_error', 'Email is not Exit. Please check you mail address.')->with('mail_resend_get', $request->email);
        }
    }
}
  /*  $to_name = $request->first_name .' '.$request->last_name ;
        $to_email = $request->email;
        $data = array('name'=>$request->first_name, 'body' => 'A test mail');
        Mail::send('emails.user_register', $data, function($message) use ($to_name, $to_email) {
        $message->to($to_email, $to_name)
        ->subject('Laravel Test Mail');
        $message->from('discovermasroorab@gmail.com','Test Mail');
        }); */
