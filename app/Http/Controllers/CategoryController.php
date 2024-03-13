<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryPaginateRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function paginate(CategoryPaginateRequest $request)
    {
        $data = $request->validated();
        $id = $data['id'];
        return $id;
//            Category::query()->where('id', '>', $id)->take(15)->get();

    }
}
