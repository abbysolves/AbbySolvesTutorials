<?php

namespace App\Modules\Admin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\User;


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

    //use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin';
    protected $email_service;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin.guest')->except('signout');
        
    }

    public function showSigninForm(){
        return view('Admin::auth.signin');
    }

    public function signin(Request $request){
       // dd($request->all());
        $this->validateLogin($request);

       
        $userObj = User::whereEmail($request->email)
                    ->where('password' , md5($request->password))
                    ->where("email_verified","=",1)
                    ->whereRaw(" ( user_type = 'ADMIN' ) ")
                    ->first();

        if ( empty($userObj)  ) {
           // $this->incrementLoginAttempts($request);
            return redirect(route("admin.signin"))->with('error', 'invalid email/password provided.');
        }


        $inputData = $request->all();

        $remember = 0;
       
        \Auth::guard('admin')->login($userObj, $remember);
        return redirect(route('admin.dashboard'));
    }


    public function signout(){
        \Auth::guard('admin')->logout();
        return redirect(route('admin.signin'));
    }


    protected function validateLogin(Request $request) {
        $this->validate($request, [
            'email' => 'required|email|string',
            'password' => 'required|string',
        ]);
    }


}
