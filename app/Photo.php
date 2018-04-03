<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = [
        'post_id', 'photo_url', 'user_id'
    ];

    public $timestamps = false;

    public function post() {

        return $this->belongsTo(Post::class);

    }
}
