<?php

namespace Database\Factories;

use App\actions\TempGetRandomImageAction;
use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

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
            'name' => ucfirst(fake('ru_RU')->word),
            'vip' => fake()->boolean(),
            'live' => fake()->boolean(),
            'image' => config('app.url') . TempGetRandomImageAction::run(),
            'new' => fake()->boolean(),
            'popular' => fake()->boolean(),
            'sort' => rand(1, 10000),
        ];
    }


}
