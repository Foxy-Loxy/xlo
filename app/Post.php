<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	protected $fillable = [
        'title', 'body', 'price', 'active', 'category_id', 'user_id'
    ];

    //
	public function index() {

		return view('layout.master');

	}

	public function user() {

		return $this->belongsTo(User::class);

	}

	public function category() {

		return $this->belongsTo(Category::class);

	}

	public function photo() {

		return $this->hasMany(Photo::class);

	}

	public function thumbnail() {

		return $this->hasOne(Photo::class);

	}

	public function  deactiveDate() {

	    return $this->created_at->addDays(14);

    }

}
