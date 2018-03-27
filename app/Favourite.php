<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
    public $timestamps = false;

    protected $fillable = ['post_id', 'user_id'];
}
