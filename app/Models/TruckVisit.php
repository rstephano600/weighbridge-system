<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TruckVisit extends Model
{
    protected $fillable = [
        'truck_id',
        'truckVisitRefNo',
        'driver_id',
        'arrival_time',
        'departure_time',
        'Status',
        'direction',
        'user_id',
    ];

    protected $casts = [
        'arrival_time' => 'datetime',
        'departure_time' => 'datetime',
    ];

    public function truck()
    {
        return $this->belongsTo(Truck::class, 'truck_id');
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id');
    }
        public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
