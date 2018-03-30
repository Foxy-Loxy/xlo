<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function phone(\App\Post $post){
        \App\PostEvent::addEvent($post, 3);
        $phone = $post->user->phone;
        return response()->json(array('phone'=> $phone), 200);
    }
}
