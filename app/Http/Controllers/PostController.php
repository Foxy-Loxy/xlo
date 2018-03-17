<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
 	
 	public function index() {

 		return view('layouts.post.index');

 	}

 	public function store(){

 	}

 	public function create() {

 		return view('layouts.post.create');

 	}

 	public function update() {

 	}

}
