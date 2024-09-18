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
        $live = fake()->boolean(30);
        return [
            'name' => ucfirst(fake('ru_RU')->word),
            'vip' => fake()->boolean(),
            'live' => $live,
            'image' => config('app.url') . TempGetRandomImageAction::img(),
            'live_image' => $live ? config('app.url') . TempGetRandomImageAction::gif() : null,
            'new' => fake()->boolean(),
            'popular' => fake()->boolean(),
            'sort' => rand(1, 10000),
        ];
    }


}
