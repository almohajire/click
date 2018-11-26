<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $fillable = ['link', 'vip_type', 'displayed', 'user_id', 'start', 'end'];

    public function conserned (){
    	return $this->belongsTo('App\User');
    }


}
