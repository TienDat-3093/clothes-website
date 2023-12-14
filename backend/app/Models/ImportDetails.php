<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportDetails extends Model
{
    use HasFactory;
    protected $table = 'import_details';
    public function products(){
        return $this->belongsTo(Products::class);
    }
    public function colors(){
        return $this->belongsTo(Colors::class);
    }
    public function sizes(){
        return $this->belongsTo(Sizes::class);
    }
}
