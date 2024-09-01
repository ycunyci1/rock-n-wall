<?php

namespace App\DTO\Resources;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;

/**
 * @OA\Schema(
 *     schema="AiPrompt",
 *     description="Ai prompt data"
 * )
 */
class AiPromptDTO extends Data
{
    public function __construct(
        /**
         * @var string
         *
         * @OA\Property(format="string", example="Это кот")
         */
        public string    $description,

        /**
         * @var string
         *
         * @OA\Property(format="string", example="gpt")
         */
        public string $model,

        /**
         * @var string
         *
         * @OA\Property(format="string", example="4")
         */
        public string $guidanceScale,
    )
    {
    }
}
