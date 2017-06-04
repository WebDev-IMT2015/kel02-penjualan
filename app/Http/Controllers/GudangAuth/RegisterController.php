<?php

namespace App\Http\Controllers\GudangAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//Validator facade used in validator method
use Illuminate\Support\Facades\Validator;

//Seller Model
use App\Gudang;

//Auth Facade used in guard
use Auth;

class RegisterController extends Controller
{
	protected $redirectPath = 'gudang_home';

    //shows registration form to gudang
	public function showRegistrationForm()
	{
		return view('gudang.auth.register');
	}

	public function register(Request $request)
    {

       //Validates data
        $this->validator($request->all())->validate();

       //Create gudang
        $gudang = $this->create($request->all());

        //Authenticates gudang
        $this->guard()->login($gudang);

       //Redirects gudangs
        return redirect($this->redirectPath);
    }

    //Validates user's Input
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:gudangs',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    //Create a new seller instance after a validation.
    protected function create(array $data)
    {
        return Gudang::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    //Get the guard to authenticate Seller
   	protected function guard()
   	{
       	return Auth::guard('web_gudang');
  	}
}
