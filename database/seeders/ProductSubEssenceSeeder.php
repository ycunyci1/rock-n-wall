<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\SubEssence;
use Illuminate\Database\Seeder;

class ProductSubEssenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::all();
        foreach ($products as $product) {
            $product->subEssences()->attach(SubEssence::query()->inRandomOrder()->first());
        }
    }
}
