<?php

namespace App\Services;

use App\Models\Essence;
use App\Models\SubEssence;

class EssenceService
{
    public function paginate(array $data, Essence $essence)
    {
        $id = $data['id'];
        if ($data['need'] == 'next') {
            return SubEssence::query()->where('essence_id', $essence->id)->where('id', '>', $id)->take(15)->get();
        } else {
            return SubEssence::query()->where('essence_id', $essence->id)
                ->where('id', '<', $id)->orderByDesc('id')->take(15)->get()->sortBy('id')->values();
        }
    }
}
