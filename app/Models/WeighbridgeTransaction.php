<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeighbridgeTransaction extends Model
{
    protected $fillable = [
        'transaction_no',
        'truck_visit_id',
        'truck_id',
        'driver_id',
        'material_id',
        'gross_weight',
        'tare_weight',
        'net_weight',
        'Status',
        'user_id',
        'direction',
    ];

    public function truckVisit()
    {
        return $this->belongsTo(Truck::class, 'truck_visit_id');
    }
    public function truck()
    {
        return $this->belongsTo(Truck::class, 'truck_id');
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id');
    }

    public function material()
    {
        return $this->belongsTo(Material::class, 'material_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function inventoryMovements()
    {
        return $this->hasMany(InventoryMovement::class);
    }
}
