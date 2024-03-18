<?php

namespace Database\Seeders;

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
            ['name' => 'selections'],
            ['name' => 'categories']
        ];
        foreach ($essences as $essence) {
            Essence::query()->create($essence);
        }
    }
}
