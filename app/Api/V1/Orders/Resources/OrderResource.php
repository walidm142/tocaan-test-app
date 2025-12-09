<?php

namespace App\Api\V1\Orders\Resources;

use Illuminate\Http\Request;
use App\Api\V1\Users\Resources\UserResource;
use App\Api\V1\Orders\Resources\ItemsResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Api\V1\Payments\Resources\PaymentsResource;

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
            'payment' => new PaymentsResource($this->whenLoaded('payment')),
            'created_by' => new UserResource($this->whenLoaded('user')),
        ];
    }
}
