<?php

namespace App\Http\Controllers\KasirAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//Validator facade used in validator method
use Illuminate\Support\Facades\Validator;

//Seller Model
use App\Kasir;

//Auth Facade used in guard
use Auth;

class RegisterController extends Controller
{
	protected $redirectPath = 'kasir_home';

    //shows registration form to kasir
	public function showRegistrationForm()
	{
		return view('kasir.auth.register');
	}

	public function register(Request $request)
    {

       //Validates data
        $this->validator($request->all())->validate();

       //Create kasir
        $kasir = $this->create($request->all());

        //Authenticates kasir
        $this->guard()->login($kasir);

       //Redirects kasirs
        return redirect($this->redirectPath);
    }

    //Validates user's Input
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:kasirs',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    //Create a new seller instance after a validation.
    protected function create(array $data)
    {
        return Kasir::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    //Get the guard to authenticate Seller
   	protected function guard()
   	{
       	return Auth::guard('web_kasir');
  	}
}
