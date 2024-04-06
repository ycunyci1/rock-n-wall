<?php

namespace App\Services;

use App\Models\Product;

class FeedService
{
    public function show(array $data)
    {
        $productsQuery = Product::query()->orderBy('sort')->orderBy('id');
        return match ($data['type']) {
            'all' => $productsQuery->get(),
            'popular' => $productsQuery->where('popular', 1)->get(),
            'new' => $productsQuery->where('new', 1)->get(),
            default => throw new \Exception('Unexpected value'),
        };
    }

    public function paginate(array $data)
    {
        $id = $data['id'];
        $lastProduct = Product::find($id);
        if ($data['need'] == 'next') {
            return Product::where(function ($query) use ($lastProduct) {
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
            return Product::where(function ($query) use ($lastProduct) {
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

