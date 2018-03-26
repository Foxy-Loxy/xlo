<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index() {
        return view('layouts.post.search');
    }

    public function show(Request $request) {
        $inputs = $request->all();
        $posts = new \App\Post;
        if(!$inputs['title'] == null)
            $posts->where('category_id', 'like', '%' . $inputs['title'] . '%');
        if(!$inputs['body'] == null)
            $posts->where('title', 'like', '%' . $inputs['body'] . '%');
        if(!$inputs['category_id'] == null)
            $posts->where('body', '=', $inputs['category_id']);
        if($inputs['city_id'] == null)
            $posts->join('users', 'users.id', '=', 'posts.user_id')
                ->where('users.city_id', '=', $inputs['city_id']);
        $posts = $posts->get();
        return view('layouts.post.index', compact('posts'));
    }
}
