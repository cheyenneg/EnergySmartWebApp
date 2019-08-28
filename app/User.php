<?php

namespace App;

use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use Notifiable;


    /**
     * Identifying the User class to user table instead of users table
     * Identifying the primary key of user table as u_id instead of id
     */
    protected $table = 'user';
    protected $primaryKey = 'u_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // Admin Auth
    public function isAdmin()
    {
        return $this->admin; 
    }

    public function home() {
        return $this->hasMany('App\Home', 'u_id');
    }

    public function energy()
    {
      return $this->hasMany('App\Energy', 'u_id');
    }
}
