<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            "client_id" => $this->client_id,
            "total_price" => $this->total_price,
            "status" => $this->status,
            "delivery_address" => $this->delivery_address,
            "updated_at" => ($this->updated_at)?->format("Y-m-d H:i:s"),
            "created_at" => ($this->created_at)?->format("Y-m-d H:i:s"),
        ];
    }
}
