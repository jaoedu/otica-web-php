<?php

namespace App\Models;

use App\Models\Promotion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'stock',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'is_active' => 'boolean',
        ];
    }

    // 🔹 TODAS as promoções (histórico)
    public function promotions()
    {
        return $this->hasMany(Promotion::class);
    }

    // 🔥 PROMOÇÃO ATIVA (ESSENCIAL)
    public function activePromotion()
    {
        return $this->hasOne(Promotion::class)
            ->where('is_active', true)
            ->whereDate('start_date', '<=', now())
            ->whereDate('end_date', '>=', now());
    }

    // 🔥 PREÇO FINAL (REGRA DE NEGÓCIO)
    public function getFinalPriceAttribute()
    {
        $promotion = $this->activePromotion;

        if ($promotion) {
            return $this->price * (1 - $promotion->discount_percent / 100);
        }

        return $this->price;
    }
}