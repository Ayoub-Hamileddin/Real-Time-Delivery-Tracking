<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasUuids;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ["client_id","total_price","status","delivery_address"];

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function deliveryTasks(){
        return $this->hasMany(DeliveryTask::class);
    }
}
