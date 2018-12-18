<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use GetSetting;
class User extends Authenticatable

{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'number_click', 'number_clicked',
        'points', 'role', 'shorten_open', 'shorten_url', 'credit_add', 'in_need'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function links(){
        return $this->hasMany('App\Link');
    }

    public function ads(){
        return $this->hasMany('App\Ad');
    }

    public function discoverdLinks(){
        return $this->belongsToMany('App\Link')->withPivot('codegen', 'id');
    }


    public function getIsAdminAttribute() {
            return $this->role > 0;
    }



    public function reports(){
        return $this->hasMany('App\Report');
    }

}
