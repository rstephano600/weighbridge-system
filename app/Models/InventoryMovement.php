<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryMovement extends Model
{
    protected $fillable = [
        'material_id',
        'weighbridge_transaction_id',
        'quantity',
        'direction',
        'posted_at',
    ];

    protected $casts = [
        'posted_at' => 'datetime',
    ];

    public function transaction()
    {
        return $this->belongsTo(WeighbridgeTransaction::class, 'weighbridge_transaction_id');
    }

    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}
