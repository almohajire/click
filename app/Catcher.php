<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Catcher extends Model
{
    protected $fillable = [
      'user_id',
      'user_ip',
      'user_agent'
    ];

    public function user(){

    	$this->belongsTo('App\User');
    	
    }
}
