<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $fillable = [
        'name',
        'license_number',
        'phone',
        'Status',
        'user_id',
    ];

    public function transactions()
    {
        return $this->hasMany(WeighbridgeTransaction::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
