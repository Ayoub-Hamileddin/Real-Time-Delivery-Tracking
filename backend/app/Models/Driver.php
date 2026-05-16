<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasUuids;
    protected $primaryKey = 'user_id';

    public $incrementing = false;

    protected $keyType = 'string';
    protected $fillable = ["user_id","vehicle_type","status","is_verified"];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function delivryTask(){
        return $this->hasMany(DeliveryTask::class);
    }

}
