<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imports extends Model
{
    use HasFactory;
    protected $table = 'imports';
    public function status(){
        return $this->belongsTo(Status::class);
    }
    public function admins(){
        return $this->belongsTo(Admins::class);
    }
    public function suppliers(){
        return $this->belongsTo(Suppliers::class);
    }
}
