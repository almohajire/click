<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{

    protected $fillable = ['hash','link', 'clicked','confirmed', 'user_id'];

    public function user(){
    	return $this->belongsTo('App\User');
    }


    public function discoverdByMany(){
        return $this->belongsToMany('App\User')->withPivot('codegen');
    }

}
