<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeighbridgeReading extends Model
{
    protected $fillable = [
        'indicator_id',
        'weight',
        'unit',
        'stable',
        'reading_time',
        'Status',
        'user_id',
    ];

    protected $casts = [
        'stable' => 'boolean',
        'reading_time' => 'datetime',
    ];
}
