<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\SubEssence;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSubEssenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productIds = Product::all()->pluck('id')->toArray();
        $subEssenceIds = SubEssence::all()->pluck('id')->toArray();
        for ($i = 1; $i <= 500; $i++) {
            DB::table('product_sub_essence')->insert([
                'product_id' => fake()->randomElement($productIds),
                'sub_essence_id' => fake()->randomElement($subEssenceIds),
            ]);
        }
    }
}
