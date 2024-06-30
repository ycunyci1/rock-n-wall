<?php

namespace App\Http\Resources;

use App\Models\SubEssence;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubEssenceShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var SubEssence $this */
        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' => $this->mainProduct->image,
            'products' => ProductResource::collection($this->products()->orderBy('sort')->orderBy('id')->take(15)->get()),
        ];
    }
}
