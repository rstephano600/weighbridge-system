<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeighbridgeIndicator extends Model
{
    protected $fillable = [
        'indicator_id',
        'ip_address',
        'port',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];
}
