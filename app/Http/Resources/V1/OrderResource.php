<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use App\Http\Resources\V1\UserResource;
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
            'id' => $this->id,
            'customer_name' => $this->name,
            'customer_email' => $this->email,
            'customer_phone' => $this->phone,
            'customer_address' => $this->address,
            'total_price' => $this->total_price,
            'status' => $this->status,
            'items' => ItemsResource::collection($this->whenLoaded('items')),
            'created_by' => new UserResource($this->whenLoaded('user')),
        ];
    }
}
