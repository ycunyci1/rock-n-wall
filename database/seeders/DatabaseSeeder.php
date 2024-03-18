<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\SubEssence;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(EssenceSeeder::class);
        Product::factory(300)->create();
        SubEssence::factory(50)->create();
        $this->call(ProductSubEssenceSeeder::class);
    }
}
