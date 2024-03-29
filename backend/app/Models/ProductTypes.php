<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTypes extends Model
{
    use HasFactory;
    protected $table = 'product_types';
    protected $fillable = [
        'name',
    ];
    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
