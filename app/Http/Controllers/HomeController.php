<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = \App\User::find(auth()->id());
        $favouritess = $user->favourites();
        //dd($favouritess);
        $user_posts = $user->posts();

        return view('layouts.dashboard.index', compact('favouritess', 'user_posts'));
    }

    public  function  store(\App\Post $post){

        if(\App\Favourite::where('post_id', $post->id)->where('user_id', auth()->id())->exists()){
            \App\Favourite::where('post_id', $post->id)->where('user_id', auth()->id())->delete();
            $q = $post->favourites;
            $q--;
            $post->favourites = $q;
            $post->save();
        } else {
            $fav = new \App\Favourite;
            $fav->post_id = $post->id;
            $fav->user_id = auth()->id();
            $fav->save();

            $q = $post->favourites;
            $q++;
            $post->favourites = $q;
            $post->save();
        }



        return back();
    }

    public function  delete(\App\User $user){
        if (auth()->user()->is_admin == true){
            $user->delete();
        }
        return back();
    }
}
