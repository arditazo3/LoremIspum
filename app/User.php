<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id', 'image_id', 'is_active','first_name', 'last_name',
        'email', 'address', 'phone', 'password', 'username', 'validated'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role() {
        return $this->belongsTo('App\Role');
    }

    public function image() {
        return $this->belongsTo('App\Image');
    }

    public function isAdmin() {
        if($this->role->status == 'Administrator') {
            return true;
        }
        return false;
    }
}
