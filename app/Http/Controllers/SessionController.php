<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\MessageBag;

class SessionController extends Controller
{

	

    public function create() {

    	return view('layouts.auth.login');

    }

    public function destroy() {

    	auth()->logout();

    	return redirect()->home();

    }

    public function store() {

    	$email = request(['email']);
    	$password = request(['password']);

    	if(! auth()->attempt(request(['email','password']))){
            $errors = new MessageBag(['password' => ['Email and/or password invalid.']]);
    		return back()->withErrors($errors)->withInput(Input::except('password'));
    	}

    	return redirect()->home(); 

    }
    
}
