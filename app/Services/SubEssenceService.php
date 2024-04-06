<?php

namespace App\Services;

use App\Models\Product;
use App\Models\SubEssence;

class SubEssenceService
{
    public function paginate(SubEssence $subEssence, array $data)
    {
        $id = $data['id'];
        if ($data['need'] == 'next') {
            return Product::query()->whereHas('subEssences', fn($subEssences) => $subEssences->where('sub_essences.id', $subEssence->id))
                ->where('id', '>', $id)->take(15)->get();
        } else {
            return Product::query()->whereHas('subEssences', fn($subEssences) => $subEssences->where('sub_essences.id', $subEssence->id))
                ->where('id', '<', $id)->orderByDesc('id')->take(15)->get()->sortBy('id')->values();
        }
    }
}
