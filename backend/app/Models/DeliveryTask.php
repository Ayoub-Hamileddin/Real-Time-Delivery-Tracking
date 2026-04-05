<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class DeliveryTask extends Model
{
    use HasUuids;

    public function order(){
        return $this->belongsTo(Order::class);
    }
    public function driver(){
        return $this->belongsTo(Driver::class);
    }

}
