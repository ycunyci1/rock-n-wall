<?php

namespace App\Services;

use App\Models\Essence;
use App\Models\SubEssence;
use Illuminate\Database\Eloquent\Collection;

class EssenceService
{
    public function paginate(array $data, Essence $essence): Collection
    {
        $id = $data['id'];
        $lastSubEssence = SubEssence::query()->find($id);
        if ($data['need'] == 'next') {
            return $essence
                ->subEssences()
                ->where('sort', '>', $lastSubEssence->sort)
                ->orderBy('sort')->orderBy('id')
                ->take(15)
                ->get();
        }
        return $essence
            ->subEssences()
            ->where('sort', '<', $lastSubEssence->sort)
            ->orderByDesc('sort')
            ->orderByDesc('id')
            ->take(15)
            ->get()
            ->sortBy([
                ['sort', 'asc'],
                ['id', 'asc'],
            ]);
    }
}
