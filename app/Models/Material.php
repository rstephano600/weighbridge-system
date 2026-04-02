<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = [
        'name',
        'type',
        'unit',
    ];

    public function transactions()
    {
        return $this->hasMany(WeighbridgeTransaction::class);
    }

    public function inventoryMovements()
    {
        return $this->hasMany(InventoryMovement::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
