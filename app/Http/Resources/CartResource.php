<?php

namespace App\Http\Resources;

use Auth;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'cart_items' => $this->getCartItems($this->resource->cartItems),
            'price_total' => $this->resource->total,
            'spending_limit' => Auth::user()->spending_limit,
        ];
    }

    private function getCartItems($cartItems)
    {
        $resources = [];
        foreach ($cartItems as $cartItem) {
            $resources[] = new CartItemResource($cartItem);
        }

        return $resources;
    }
}
