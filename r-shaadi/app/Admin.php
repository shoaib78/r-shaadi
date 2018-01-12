<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Admin extends Authenticatable
{
    protected $table = "admin";

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname','lastname','email', 'password','profession','about_me'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public static function registeruser($input = array()) {
            return Admin::create([
                    'name' => $input['name'],
                    'email' => $input['email'],
                    'password' => bcrypt($input['password']),
                ]);
    }
    
}
