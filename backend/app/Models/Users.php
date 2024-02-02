<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Users extends Authenticatable implements JWTSubject
{
    use HasFactory;
    protected $table = 'users';
    protected $fillable = [
        'username',
        'fullname',
        'email',
        'address',
        'password',
        'phone_number',
        'login_at',
    ];
    public function status()
    {
        return $this->belongsTo(StatusUsers::class);
    }
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
}
