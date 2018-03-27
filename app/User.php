<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'city_id'
    ];

    public function posts() {

        return $this->hasMany(Post::class)->get();

    }

    public function favourites() {

        $fav_arr = \App\Favourite::where('user_id', '=', $this->id)->get();
//        dd($fav_arr);
        $post_obj = new \App\Post;
        foreach ($fav_arr as $fav){
            $post_obj->where('id', '=', $fav->post_id);
        }
        $post_arr = $post_obj->get();
        return $post_arr;
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
