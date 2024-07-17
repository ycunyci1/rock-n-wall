<?php

namespace App\Services;

use App\Models\Product;

class FeedService
{
    public function show(array $data)
    {
        $productsQuery = Product::query()->orderBy('sort')->orderBy('id');

        return match ($data['type']) {
            'popular' => $productsQuery->where('popular', 1)->take(15)->get(),
            'new' => $productsQuery->where('new', 1)->take(15)->get(),
            default => $productsQuery->take(15)->get(),
        };
    }

    public function paginate(array $data)
    {
        $id = $data['id'];
        $lastProduct = Product::find($id);

        $productBaseRequest = Product::query()->orderBy('sort')->orderBy('id');
        $productRequest = match ($data['type']) {
            'popular' => $productBaseRequest->where('popular', 1),
            'new' => $productBaseRequest->where('new', 1),
            default => $productBaseRequest
        };

        if ($data['need'] == 'next') {
            return $productRequest->where(function ($query) use ($lastProduct) {
                $query->where('sort', '>', $lastProduct->sort)
                    ->orWhere(function ($query) use ($lastProduct) {
                        $query->where('sort', '=', $lastProduct->sort)
                            ->where('id', '>', $lastProduct->id);
                    });
            })
                ->orderBy('sort', 'asc')
                ->orderBy('id', 'asc')
                ->take(15)
                ->get();
        } else {
            return $productRequest->where(function ($query) use ($lastProduct) {
                $query->where('sort', '<', $lastProduct->sort)
                    ->orWhere(function ($query) use ($lastProduct) {
                        $query->where('sort', '=', $lastProduct->sort)
                            ->where('id', '<', $lastProduct->id);
                    });
            })
                ->orderBy('sort', 'desc')
                ->orderBy('id', 'desc')
                ->take(15)
                ->get()
                ->sortBy(function ($product) {
                    return sprintf('%-12s%s', $product->sort, $product->id);
                });
        }
    }
}
