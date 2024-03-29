<?php

namespace App\Services;

use App\Http\Resources\SliderItemResource;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubEssence;
use Illuminate\Database\Eloquent\Collection;

class ProductService implements ProductServiceInterface
{
    public function getMainPageInfo(): array
    {
        $products = $this->getLiveImages();
        $categories = $this->getCategories();

        return [
            'liveImage' => SliderItemResource::collection($products),
            'categories' => SliderItemResource::collection($categories),
        ];
    }

    public function getLiveImages(): Collection
    {
        return Product::query()->where('live', 1)->take(15)->get();
    }

    public function getCategories(): Collection
    {
        return SubEssence::query()->where('essence_id', 2)->take(15)->get();
    }
}
