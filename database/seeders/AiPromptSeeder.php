<?php

namespace Database\Seeders;

use App\Models\AiPrompt;
use App\Models\Product;
use Illuminate\Database\Seeder;

class AiPromptSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Product::all() as $product) {
            if (fake()->boolean(40)) {
                $prompt = AiPrompt::query()->create([
                    'description' => fake()->text(50),
                    'model' => fake()->word,
                    'guidanceScale' => strval(rand(1, 20))
                ]);
                $product->update(['ai_prompt_id' => $prompt->id]);
            }
        }
    }
}
