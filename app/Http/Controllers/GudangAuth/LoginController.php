<?php

namespace App\Http\Controllers\GudangAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//Class needed for login and Logout logic
use Illuminate\Foundation\Auth\AuthenticatesUsers;


//Auth facade
use Auth;

class LoginController extends Controller
{
	//Where to redirect seller after login.
    protected $redirectTo = '/gudang_home';	

    //Trait
    use AuthenticatesUsers;

    //Custom guard for seller
    protected function guard()
    {
      return Auth::guard('web_gudang');
    }

    //Shows seller login form
   	public function showLoginForm()
   	{
       	return view('gudang.auth.login');
   	}
}