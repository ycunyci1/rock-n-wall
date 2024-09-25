<?php

namespace Database\Factories;

use App\actions\TempGetRandomImageAction;
use App\Services\ImageService;
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
        $pathToGif = $live ? TempGetRandomImageAction::gif() : null;

        return [
            'name' => ucfirst(fake('ru_RU')->word),
            'vip' => fake()->boolean(),
            'live' => $live,
            'image' => !$live
                ? config('app.url') . TempGetRandomImageAction::img()
                : config('app.url') . ImageService::getPreviewForGif($pathToGif),
            'live_image' => $live ? config('app.url') . $pathToGif : null,
            'new' => fake()->boolean(),
            'popular' => fake()->boolean(),
            'sort' => rand(1, 10000),
        ];
    }


}
