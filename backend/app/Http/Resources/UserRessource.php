<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserRessource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            "id" => $this->id,
            "full_name" => $this->full_name,
            "phone_number" => $this->phone_number,
            "email" => $this->email,
            "role" => $this->role,
            "address" => $this->address,
            "updated_at" => ($this->updated_at)->format("Y-m-d H:i:s"),
            "created_at" => ($this->created_at)->format("Y-m-d H:i:s"),
        ];
    }
}
