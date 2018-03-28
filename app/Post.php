<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Post extends Model
{
    //fillable fields
    protected $fillable=['title','body','user_id'];

    //adding a relationship to user
    public function user()
    {
    	return $this->belongsTo('App\User');

    }
}
