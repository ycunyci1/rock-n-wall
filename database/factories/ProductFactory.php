<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->text(5),
            'vip' => fake()->boolean(),
            'live' => fake()->boolean(),
            'image' => fake()->imageUrl,
            'new' => fake()->boolean(),
            'popular' => fake()->boolean(),
            'sort' => rand(1, 10000),
        ];
    }
}
