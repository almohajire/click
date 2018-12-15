<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
	protected $fillable = ['user_id', 'message'];


    public function reporter (){
    	return $this->belongsTo('App\User', 'user_id');
    }
}
