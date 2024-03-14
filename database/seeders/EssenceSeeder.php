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
        $groups = [0 => 'selections', 1 => 'categories', 2 => 'live papers'];
        foreach ($groups as $group=>$key) {
            Essence::create(['name' => $key]);
        }
    }
}
