<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

class AdminLoginController extends Controller
{


    use AuthenticatesUsers;


    protected $redirectTo = '/welcome';

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function login_form(){
      return view('auth.admin_login');
    }
    public function login(Request $request){
      $this->validate($request,[
        'email' => 'required',
        'password' => 'required'
      ]);
      if (Auth::guard('admin')->attempt(['email'=>$request->email,'password' => $request->password],$request->remember)) {
        return redirect()->intended('/welcome');
      }
      return redirect()->back()->withInput($request->only('email','remember'))->withErrors(['email'=>'These credentials do not match our records.']);
    }

    public function logout(){
      Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }


}
