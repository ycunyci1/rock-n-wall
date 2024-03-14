<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryImagesRequest;
use App\Http\Requests\CategoryPaginateRequest;
use App\Http\Resources\ProductListResource;
use App\Models\Category;
use App\Models\SubEssence;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $service;

    public function __construct(CategoryService $categoryService)
    {
        $this->service = $categoryService;
    }

    public function paginate(CategoryPaginateRequest $request)
    {
        $data = $request->validated();
        $paginate = $this->service->paginate($data);

        return response()->json($paginate);
    }

    public function showCategoryImages(SubEssence $subEssence)
    {
        $category = $subEssence->where('essence_id', 2)->get();
        return response()->json(ProductListResource::collection($category->take(15)));
    }
}
