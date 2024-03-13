<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productIds = Product::all()->pluck('id')->toArray();
        $categoryIds = Category::all()->pluck('id')->toArray();
        for ($i = 1; $i <= 300; $i++) {
            DB::table('category_product')->insert([
                'category_id' => fake()->randomElement($categoryIds),
                'product_id' => fake()->unique()->randomElement($productIds),
            ]);
        }
    }
}
