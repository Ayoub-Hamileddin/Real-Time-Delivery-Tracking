<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class DeliveryTask extends Model
{
    use HasUuids;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        "driver_id",
        "order_id",
        "status",
        "pickup_latitude",
        "pickup_longitude",
        "dropoff_latitude",
        "dropoff_longitude",
    ];

    public function order(){
        return $this->belongsTo(Order::class);
    }
    public function driver(){
        return $this->belongsTo(Driver::class);
    }

}
