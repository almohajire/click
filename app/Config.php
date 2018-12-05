<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
        protected $fillable = [
    		'slug',
            'nameSetting',
            'value',
            'type'
    ];
}
