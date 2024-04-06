<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'product' => [
                'id' => $this->id,
                'name' => $this->name,
                'vip' => boolval($this->vip),
                'live' => boolval($this->live),
                'image' => $this->image,
            ],
            'info' => ProductInfoResource::collection($this->subEssences)
        ];
    }
}
