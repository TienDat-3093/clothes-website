<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discounts extends Model
{
    use HasFactory;
    protected $table = 'discounts';
    protected $fillable = [
        'name',
        'amount_discounts',
        'type_discount',
        'start_date',
        'end_date',
    ];

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
