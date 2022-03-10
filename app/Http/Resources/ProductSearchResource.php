<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductSearchResource extends JsonResource
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
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'image' => $this->resource->image,
            'department' => $this->resource->department,
            'description' => isset($this->resource->description) ? $this->getDescription($this->resource->description) : null,
            'price' => $this->resource->price,
        ];
    }

    public function getDescription($descriptions): array
    {
        $resources = [];
        foreach ($descriptions as $description) {
            $resources[] = $description;
        }

        return $resources;
    }
}
