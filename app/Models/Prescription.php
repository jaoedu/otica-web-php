<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    protected $fillable = [
        'order_id',
        'file',
        'observations',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
