<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaginateRequest;
use App\Http\Resources\ProductResource;
use App\Http\Resources\SubEssenceShowResource;
use App\Models\Essence;
use App\Models\SubEssence;
use App\Services\SubEssenceService;

class SubEssenceController extends Controller
{
    public function show(Essence $essence, SubEssence $subEssence)
    {
        return response()->json(SubEssenceShowResource::make($subEssence));
    }

    public function paginate(Essence $essence, SubEssence $subEssence, PaginateRequest $request)
    {
        $data = $request->validated();
        $products = app(SubEssenceService::class)->paginate($subEssence, $data);

        return response()->json(ProductResource::collection($products));
    }
}
