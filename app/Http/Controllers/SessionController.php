<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    		return back();

    	}

    	return redirect()->home(); 

    }
    
}
