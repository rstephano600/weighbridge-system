<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IndicatorLog extends Model
{
    protected $fillable = [
        'indicator_id',
        'raw_message',
        'logged_at',
    ];

    protected $casts = [
        'logged_at' => 'datetime',
    ];
}
