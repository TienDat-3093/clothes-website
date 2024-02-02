<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suppliers extends Model
{
    use HasFactory;
    protected $table = 'suppliers';
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'address',
    ];
    public function status()
    {
        return $this->belongsTo(StatusUsers::class);
    }
}
