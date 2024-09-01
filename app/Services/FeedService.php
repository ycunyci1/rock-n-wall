<?php

namespace App\Services;

use App\Models\Product;
use App\Models\SubEssence;
use Illuminate\Database\Eloquent\Collection;

class FeedService
{
    public function show(array $data)
    {
        $productsQuery = Product::query()->orderBy('sort')->orderBy('id');
        if (isset($data['q'])) {
            $searchTerm = $data['q'];
            $productsQuery->where('name', 'LIKE', "%$searchTerm%")
                ->orWhereHas('tags', fn ($query) => $query->where('name', 'LIKE', "%$searchTerm%"));
        }

        return match ($data['type']) {
            'popular' => $productsQuery->where('popular', 1)->take(15)->get(),
            'new' => $productsQuery->where('new', 1)->take(15)->get(),
            default => $productsQuery->take(15)->get(),
        };
    }

    public function paginate(array $data): Collection
    {
        $page = $data['page'] ?? 1;
        $productBaseRequest = Product::orderBy('sort')->orderBy('id');

        $productRequest = match ($data['type']) {
            'popular' => $productBaseRequest->where('popular', 1),
            'new' => $productBaseRequest->where('new', 1),
            default => $productBaseRequest
        };

        return $productRequest
            ->skip(($page - 1) * 15)
            ->take(15)
            ->get()->values();
    }
}
