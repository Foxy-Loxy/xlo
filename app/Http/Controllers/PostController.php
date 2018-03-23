<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{

	public function __construct() {

		$this->middleware('auth')->except(['index', 'show']);

	}
 	
 	public function index() {

		$posts = \App\Post::latest()->orderBy('active','desc')->get();

 		return view('layouts.post.index', compact('posts'));
 	}

 	public function store(Request $request){

	    if (request('update') == 'true'){



        } else {
            $this->validate(request(), [
                'title' => 'required',
                'body' => 'required',
                'category_id' => 'required',
                'image' => 'max:2048',
                'price' => 'integer'
            ]);


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
        }

    	return redirect('/');

 	}

 	public function create() {

 		return view('layouts.post.create');

 	}

 	public function update(\App\Post $post) {

		return view('layouts.post.create', compact('post'));

	 }

	 public function edit(\App\Post $post) {
 	    //dd(\request()->all());
        if($post->user->id == auth()->id()){
            $this->validate(request(), [
                'title' => 'required',
                'body' => 'required',
                'category_id' => 'required',
                'image' => 'max:2048',
                'price' => 'integer'
            ]);
            \App\Post::where('id', '=', $post->id)
                ->update([  'title' => \request('title'),
                            'body' => \request('body'),
                            'price' => \request('price'),
                            'category_id' => \request('category_id'),]);
            if(isset(\request()->all()['image'])) {
                $img_arr = \request('image');
                \App\Photo::where('post_id', '=', $post->id)->delete();
                $n = 0;
                foreach ($img_arr as $image) {
                    $filename = $image->store('photos');
                    \App\Photo::create([
                        'post_id' => $post->id,
                        'photo_url' => $filename
                    ]);
                    if ($n > 5)
                        break;
                }
            }
        }

        return redirect()->home();
     }
	 
	 public function show(\App\Post $post){

		return view('layouts.post.show', compact('post'));

	 }

	public function destroy(\App\Post $post) {

		if ($post->user->id == auth()->id()) {
			$post_del = new \App\Post;
			$post_del->where('id', '=', $post->id)->delete();
		}

		return redirect()->home();
	}

}
