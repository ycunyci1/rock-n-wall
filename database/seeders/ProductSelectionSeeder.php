<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Selection;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSelectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productIds = Product::all()->pluck('id')->toArray();
        $selectionIds = Selection::all()->pluck('id')->toArray();
        for ($i = 1; $i <= 150; $i++) {
            DB::table('product_selection')->insert([
                'product_id' => fake()->randomElement($productIds),
                'selection_id' => fake()->randomElement($selectionIds),
            ]);
        }

    }
}
