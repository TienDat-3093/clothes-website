<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetails extends Model
{
    use HasFactory;
    protected $table = 'product_details';
    public function product()
    {
        return $this->belongsTo(Products::class,'products_id');
    }
    public function color()
    {
        return $this->hasMany(Colors::class,'id','colors_id');
    }
    public function size()
    {
        return $this->hasMany(Sizes::class,'id','sizes_id');
    }
}
