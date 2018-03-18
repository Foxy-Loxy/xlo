<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = [
        'post_id', 'photo_url'
    ];

    public $timestamps = false;
}
