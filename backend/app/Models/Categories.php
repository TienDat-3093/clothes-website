<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;
    protected $table = 'categories';
<<<<<<< HEAD

    public function products()
    {
        return $this->hasMany(Products::class);
=======
    public function product_types()
    {
        return $this->belongsTo(ProductTypes::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
>>>>>>> 6ff6d132a2f8fc31dbb2937cba1ac823e1c0dc6f
    }
}
