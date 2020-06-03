<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * User roles
     */
    const ADMINISTRATOR_ROLE = 'Administrator';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Function to check if user is Administrator
     *
     * @return bool
     */
    public function isAdministrator()
    {
        return $this->role === self::ADMINISTRATOR_ROLE;
    }

    /**
     * Function to check if user is Manager
     *
     * @param $role
     * @return bool
     */
    public function hasRole($role)
    {
        return $this->role === $role;
    }

    public function memberships()
    {
//        return $this->belongsToMany('App\Membership', 'user_company', 'user_id', 'company_id');
        return $this->belongsToMany('App\Membership');
    }
}
