<?php

namespace Database\Seeders;

use App\Enum\EssenceDisplayTypeEnum;
use App\Models\Essence;
use Illuminate\Database\Seeder;

class EssenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $essences = [
            ['name' => 'Selections', 'display_type' => EssenceDisplayTypeEnum::DISPLAY_TYPE_HORIZONTAL],
            ['name' => 'Categories', 'display_type' => EssenceDisplayTypeEnum::DISPLAY_TYPE_VERTICAL],
        ];
        foreach ($essences as $essence) {
            Essence::query()->create($essence);
        }
    }
}
