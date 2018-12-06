<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


use Illuminate\Database\Eloquent\SoftDeletes;

class Clicklink extends Model
{

	use SoftDeletes;

	protected $dates = ['deleted_at'];


    protected $table = 'link_user';

    protected $fillable = ['user_id', 'link_id'];


    public function user(){

    	$this->belongsTo('App\User');

    }

    public function link(){

    	$this->belongsTo('App\Link');

    }



}
