<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostEvent extends Model
{
    public static function addEvent(\App\Post $post, $type){
        if(!is_numeric($type))
            trigger_error('Type must be numeric', E_USER_ERROR);
        $event = new \App\PostEvent;
        $event->post_id = $post->id;
        $event->type = $type;
        $event->save();

        //Trigger views increase in posts
        //Just because I'm too lazy to refactor it :p
        if($type == 1){
            $q = $post->views;
            $q++;
            $post->views = $q;
            $post->save();
        }
    }
}
