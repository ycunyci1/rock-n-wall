<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaginateRequest;
use App\Http\Resources\SubEssenceResource;
use App\Http\Resources\SubEssenceShowResource;
use App\Models\Essence;
use App\Services\EssenceService;

class EssenceController extends BaseApiController
{
    private EssenceService $service;

    public function __construct(EssenceService $categoryService)
    {
        $this->service = $categoryService;
    }

    public function show(Essence $essence)
    {
        return response()->json(SubEssenceResource::collection($essence->subEssences()->orderBy('sort')->orderBy('id')->take(15)->get()));
    }

    public function paginate(PaginateRequest $request, Essence $essence)
    {
        $data = $request->validated();
        $subEssences = $this->service->paginate($data, $essence);

        return response()->json(SubEssenceResource::collection($subEssences));
    }
}
