<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Status;

class Colors extends Model
{
    use HasFactory;
    protected $table = 'colors';
    protected $fillable = [
        'name',
    ];
    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
