<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'username',
        'email',
        'password',
        'permission',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function scopeExistUser($query, $username){
        return $query->where('username', $username)->orWhere('email', $username);
    }
}
