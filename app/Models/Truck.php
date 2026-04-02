<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Truck extends Model
{
    protected $fillable = [
        'plate_number',
        'company',
        'capacity',
        'Status',
        'user_id',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function visits()
    {
        return $this->hasMany(TruckVisit::class);
    }

    public function transactions()
    {
        return $this->hasMany(WeighbridgeTransaction::class);
    }
}
