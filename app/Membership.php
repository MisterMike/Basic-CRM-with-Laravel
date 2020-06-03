<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'email',
        'price',
        'playing_alowed'
    ];

    //employees
    public function members()
    {
        return $this->hasMany('App\Member');
    }

    //users
    public function users()
    {
//        return $this->belongsToMany('App\User', 'user_membership', 'membership_id', 'user_id');
        return $this->belongsToMany('App\User');
    }
}
