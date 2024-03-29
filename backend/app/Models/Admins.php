<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admins extends Authenticatable
{
    use HasFactory;
    protected $table = 'admins';
    protected $fillable = [
        'username',
        'fullname',
        'email',
        'password',
        'phone_number',
    ];
    public function status()
    {
        return $this->belongsTo(StatusUsers::class);
    }
}
