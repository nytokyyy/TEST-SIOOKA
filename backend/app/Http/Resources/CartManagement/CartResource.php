<?php

namespace App\Http\Resources\CartManagement;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
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
            'cartItems' => CartItemResource::collection($this->whenLoaded('cartItems')),
            'total' => $this->total()
        ];
    }
}
