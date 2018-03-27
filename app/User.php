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
        $fav_arr = \App\Favourite::where('user_id', '=', auth()->id())->get();
        $id_arr = array();
        $post_obj = new \App\Post;
        if (\App\Favourite::where('user_id', '=', auth()->id())->exists()){
            foreach ($fav_arr as $fav) {
                array_push($id_arr, $fav->post_id);
            }
            $post_obj = $post_obj->whereIn('id', $id_arr)->get();
        }
        return $post_obj;
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
