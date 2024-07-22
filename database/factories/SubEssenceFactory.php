<?php

namespace Database\Factories;

use App\Models\Essence;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubEssence>
 */
class SubEssenceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => ucfirst(fake('ru_RU')->word),
            'main_product_id' => fake()->randomElement(Product::all()),
            'essence_id' => fake()->randomElement(Essence::all()),
            'sort' => rand(1, 10000),
        ];
    }
}
