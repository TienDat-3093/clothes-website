<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carts extends Model
{
    use HasFactory;
    protected $table = 'carts';
    public function status_carts()
    {
        return $this->belongsTo(StatusCarts::class);
    }
    public function users()
    {
        return $this->belongsTo(Users::class);
    }
    public function discounts()
    {
        return $this->belongsTo(Discounts::class);
    }
}
