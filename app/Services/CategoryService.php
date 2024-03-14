<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    public function paginate(array $data)
    {
        $id = $data['id'];
        if ($data['need'] == 'next') {
            return Category::query()->where('id', '>', $id)->take(15)->get();
        } else {
            return Category::query()->where('id', '<', $id)->orderByDesc('id')->take(15)->get()->sortBy('id')->values();
        }
    }
}
