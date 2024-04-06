<?php

namespace App\Services;

use App\Http\Resources\MainPageEssenceResource;
use App\Http\Resources\ProductResource;
use App\Models\Essence;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProductService
{
    public function getMainPageInfo(): array
    {
        return [
            'liveImage' => ProductResource::collection($this->getLiveImages()),
            'essences' => $this->getEssences(),
        ];
    }

    public function getLiveImages(): Collection
    {
        return Product::query()->where('live', 1)->take(15)->get();
    }

    public function getEssences(): AnonymousResourceCollection
    {
        return MainPageEssenceResource::collection(Essence::with('subEssences.products', 'subEssences.mainProduct')->get());
    }
}
