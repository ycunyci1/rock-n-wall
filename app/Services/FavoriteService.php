<?php

namespace App\Services;

use App\DTO\Resources\FavoriteEssenceDTO;
use App\DTO\Resources\AiPromptDTO;
use App\DTO\Resources\ProductDTO;
use App\DTO\Resources\ProductInfoDTO;
use App\DTO\Resources\ProductShowDTO;
use App\Models\Essence;
use App\Models\Product;
use App\Models\SubEssence;
use App\Http\Resources\ProductResource;
use App\Models\Favorite;

class FavoriteService
{
    public static function getFavorites(): array
    {
        $user = auth()->user();

        $favorites = $user->favorites;

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
        $essences = Essence::all();
        $essencesData = [];
        foreach ($groupedSubEssencesByEssenceId as $essenceId => $subEssences) {
            $essence = $essences->where('id', $essenceId)->first();
            $essencesData[] = FavoriteEssenceDTO::from($essence, ['subEssences' => $subEssences]);
        }

        $productCollect = collect();
        foreach ($productsCollect as $product) {
            $productCollect->push(ProductShowDTO::from([
                    'product' => ProductDTO::from($product->toArray()),
                    'info' => ProductInfoDTO::collect($product->subEssences),
                    'promptDetail' => $product->aiPrompt ? AiPromptDTO::from($product->aiPrompt->toArray()) : null
                ]
            ));
        }
        return [
            'all' => $productCollect,
            'essences' => $essencesData,
        ];
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
            'favoritable_type' => $model,
        ])->first()?->delete();
    }
}
