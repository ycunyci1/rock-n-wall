<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\SubEssence;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(EssenceSeeder::class);
        Product::factory(2000)->create();
        SubEssence::factory(50)->create();
        User::factory(10)->create();
        $this->call(ProductSubEssenceSeeder::class);
        Tag::factory(20)->create();
    }
}
