<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DeliveryTaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [

            "id" => $this->id,
            "driver_id" => $this->driver_id,
            "order_id" => $this->order_id,
            "status" => $this->status,
            "pickup_latitude" => $this->pickup_latitude,
            "pickup_longitude" => $this->pickup_longitude,
            "dropoff_latitude" => $this->dropoff_latitude,
            "dropoff_longitude" => $this->dropoff_longitude,
            "updated_at" => ($this->updated_at)?->format("Y-m-d H:i:s"),
            "created_at" => ($this->created_at)?->format("Y-m-d H:i:s"),

        ];
    }
}
