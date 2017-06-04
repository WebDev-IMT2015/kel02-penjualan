<?php

namespace App\Http\Controllers\KasirAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//Class needed for login and Logout logic
use Illuminate\Foundation\Auth\AuthenticatesUsers;


//Auth facade
use Auth;

class LoginController extends Controller
{
	//Where to redirect seller after login.
    protected $redirectTo = '/kasir_home';	

    //Trait
    use AuthenticatesUsers;

    //Custom guard for seller
    protected function guard()
    {
      return Auth::guard('web_kasir');
    }

    //Shows seller login form
   	public function showLoginForm()
   	{
       	return view('kasir.auth.login');
   	}
}