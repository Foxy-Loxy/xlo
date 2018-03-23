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
        if($inputs['title'] == null)
            $inputs['title'] = '*';
        else $inputs['title'] = '%' . $inputs['title'] . '%';
        if($inputs['body'] == null)
            $inputs['body'] = '*';
        else $inputs['body'] = '%' . $inputs['body'] . '%';
        if($inputs['category_id'] == null)
            $inputs['category_id'] = '*';
        if($inputs['city_id'] == null)
            $inputs['city_id'] = '*';
        dd($inputs);
        $posts = new \App\Post;
        $found = $posts->where('category_id', '=', $inputs['category_id'])
                        ->where('title', 'like', $inputs['title'])
                        ->where('body', 'like', $inputs['body'])
                        ->where(\App\Post::user()->city, '=', $inputs['city_id'])
                        ->get();
        dd($found);
        return view('layouts.post.index', compact($posts));
    }
}
