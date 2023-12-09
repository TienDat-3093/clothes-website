<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;
    protected $table = 'categories';

    public function products()
    {
        return $this->hasMany(Products::class);
    }
    public function product_types()
    {
        return $this->belongsTo(ProductTypes::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
