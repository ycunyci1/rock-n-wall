<?php

namespace App\Http\Controllers;

use App\Http\Requests\FeedRequest;
use App\Http\Requests\PaginateRequest;
use App\Http\Requests\SearchRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Services\FeedService;


class FeedController extends Controller
{
    public function show(FeedRequest $request)
    {
        $data = $request->validated();
        if(!isset($data['type'])) {
            $data['type'] = 'all';
        }
        $feed = app(FeedService::class)->show($data);

        return response()->json(ProductResource::collection($feed));
    }

    public function paginate(PaginateRequest $request)
    {
        $data = $request->validated();
        $products = app(FeedService::class)->paginate($data);

        return response()->json(ProductResource::collection($products));
    }

    public function search(SearchRequest $request)
    {
        $data = $request->validated();
        $searchTerm = $data['searchTerm'];
        // todo: Вынести в сервис
        $result = Product::query()->where('name', 'LIKE', "%$searchTerm%")
            ->orWhereHas('tags', fn ($query)
            => $query->where('name', 'LIKE', "%$searchTerm%")
            )->get();

        return response()->json(ProductResource::collection($result));
    }
}
