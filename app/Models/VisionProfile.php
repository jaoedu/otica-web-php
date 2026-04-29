<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisionProfile extends Model
{
    protected $fillable = [
        'user_id',
        'uses_glasses',
        'lens_type',
        'condition',
        'light_sensitivity',
        'observations',
    ];

    protected $casts = [
        'uses_glasses' => 'boolean',
        'light_sensitivity' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
