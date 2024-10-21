<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductInfoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'subEssenceId' => $this->id,
            'essence' => $this->essence->name,
            'subEssenceName' => $this->name,
            'mainImage' => $this->image,
            'count' => $this->products->count(),
        ];
    }
}
