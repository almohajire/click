<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{

    protected $fillable =['link', 'clicked','confirmed', 'user_id'];

    public function user(){
    	return $this->belongsTo('App\User');
    }
}
