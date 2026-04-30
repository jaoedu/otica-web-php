<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'total',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELACIONAMENTO COM USER
    |--------------------------------------------------------------------------
    */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /*
    |--------------------------------------------------------------------------
    | RELACIONAMENTO COM ITENS DO PEDIDO
    |--------------------------------------------------------------------------
    */
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
