<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\SubEssence;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(AdminSeeder::class);
        $this->call(EssenceSeeder::class);
        Product::factory(300)->create();
        SubEssence::factory(50)->create();
        User::factory(1)->create();
        $this->call(ProductSubEssenceSeeder::class);
    }
}
