<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // create a relationship between user and post models
    // a post belongs to a user
    public function user(){
        return $this->belongsTo('App\User');
    }
}
