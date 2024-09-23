<?php

namespace App\Services;

use App\Models\Product;
use App\Models\SubEssence;
use Illuminate\Database\Eloquent\Collection;

class SubEssenceService
{
    public function paginate(SubEssence $subEssence, array $data): Collection
    {
        $page = $data['page'] ?? 1;
            return $subEssence
                ->products()
                ->orderBy('sort')
                ->orderBy('id')
                ->skip(($page - 1) * 30)
                ->take(30)
                ->get()->values();
    }
}
