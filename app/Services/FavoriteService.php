<?php

namespace App\Services;

use App\Http\Resources\ProductResource;
use App\Http\Resources\SubEssenceResource;
use App\Models\Essence;
use App\Models\Favorite;
use App\Models\Product;
use App\Models\SubEssence;

class FavoriteService
{
    public static function getFavorites(): array
    {
        $user = auth()->user();

        $favorites = $user->favorites->load('favoritable');

        $productsCollect = collect();
        $subEssencesCollect = collect();

        $products = $favorites->where('favoritable_type', Product::class);
        foreach ($products as $product) {
            $productsCollect->push($product->favoritable);
        }

        $subEssences = $favorites->where('favoritable_type', SubEssence::class);
        foreach ($subEssences as $subEssence) {
            $subEssencesCollect->push($subEssence->favoritable);
        }
        $groupedSubEssencesByEssenceId = $subEssencesCollect->groupBy('essence_id');
        $subEssencesData = [];
        $essences = Essence::all();

        foreach ($groupedSubEssencesByEssenceId as $essenceId => $subEssences) {
            $subEssencesData[$essences->where('id', $essenceId)->first()->name] = SubEssenceResource::collection($subEssences);
        }

        $allProducts = [
            'all' => ProductResource::collection($productsCollect)
        ];

        return array_merge($allProducts, $subEssencesData);
    }

    public function addToFavorite(string $model, int $id): void
    {
        Favorite::query()->updateOrCreate([
            'user_id' => auth()->id(),
            'favoritable_id' => $id,
            'favoritable_type' => $model,
        ]);
    }

    public function deleteFromFavorite(string $model, int $id): void
    {
        Favorite::query()->where([
            'user_id' => auth()->id(),
            'favoritable_id' => $id,
            'favoritable_type' => $model
        ])->first()?->delete();
    }
}

