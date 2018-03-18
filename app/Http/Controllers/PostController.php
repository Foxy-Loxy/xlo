<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{

	public function __construct() {

		$this->middleware('auth')->except(['index', 'show']);

	}
 	
 	public function index() {

		$posts = \App\Post::latest()->get();

 		return view('layouts.post.index', compact('posts'));
 	}

 	public function store(Request $request){

		$this -> validate(request(),[
    		'title' => 'required',
			'body' => 'required',
			'category_id' => 'required',
			'image' => 'max:2048',
			'price' => 'integer'
		]);
		
		if (request('price') == '0') 
			$request->merge(['price' => 'FREE']);

        $val = \App\Post::create([
            'body' => request('body'),
            'title' => request('title'),
			'user_id' => auth()->id(),
			'category_id' => request('category_id'),
			'price' => request('price')
		]);
		
		$n = 0;


        foreach ($request->image as $image) {
            $filename = $image->store('photos');
            \App\Photo::create([
                'post_id' => $val->id,
                'photo_url' => $filename
			]);
			if ($n > 5)
				break;
		}

    	return redirect('/');

 	}

 	public function create() {

 		return view('layouts.post.create');

 	}

 	public function update() {

	 }
	 
	 public function show(\App\Post $post){

		return view('layouts.post.show', compact('post'));

	 }

}
