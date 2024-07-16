<?php

namespace App\Services;

use App\Models\Product;
use App\Models\SubEssence;
use Illuminate\Database\Eloquent\Collection;

class SubEssenceService
{
    public function paginate(SubEssence $subEssence, array $data): Collection
    {
        $id = $data['id'];
        $sort = Product::query()->find($id)?->sort;
        if ($data['need'] == 'next') {
            return $subEssence
                ->products()
                ->orderBy('sort')
                ->orderBy('id')
                ->where('sort', '>', $sort)
                ->take(15)
                ->get()->values();
        } else {
            return $subEssence->products()
                ->where('sort', '<', $sort)
                ->orderByDesc('sort')
                ->orderByDesc('id')
                ->take(15)
                ->get()
                ->sortBy([
                    ['sort', 'asc'],
                    ['id', 'asc'],
                ])->values();
        }
    }
}
