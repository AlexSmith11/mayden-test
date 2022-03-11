<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CartItemResource extends JsonResource
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
            'product_id' => $this->resource->product_id,
            'name' => $this->getName(),
            'rank' => $this->resource->rank,
            'quantity' => $this->resource->quantity,
            'price' => $this->getPrice(),
        ];
    }

    private function getPrice() {
        return $this->resource->product->price;
    }

    private function getName()
    {
        return $this->resource->product->name;
    }
}
