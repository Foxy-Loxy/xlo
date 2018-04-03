<?php

namespace App\Http\Controllers;

//use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    
	public function __construct( ) {

		$this->middleware('guest');

	}

	public function create() {

		return view('layouts.auth.register');

	}

	public function store(Request $request) {

		$this->validate(request(), [
			'name' => 'required',
			'email' => 'required|email|unique:users',
			'phone' => 'required|regex:/(380)[0-9]{9}/|unique:users',
			'city_id' => 'required', 
			'password' => 'required|confirmed|regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/'
		]);





		$req = request([
    		'name',
    		'email',
    		'password',
    		'phone',
    		'city_id'
		]);
		
    	$req['password'] = bcrypt($req['password']);

		$user = \App\User::create($req);

		auth()->login($user);

		session()->flash('message', "You\'ve successfully signed up and ready to go ! Enjoy our service");

		return redirect()->home();

	}

}
