<?php

namespace App\DTO\Resources;

use Spatie\LaravelData\Data;

/**
 * @OA\Schema(
 *     schema="PictureInforamtionModal",
 *     description="Данные для модалки с информацией откуда получено изображение"
 * )
 */
class ProductPictureInformation extends Data
{
    /**
     * @OA\Property(format="string", example="Brain Dude")
     */
    public ?string $author = null;

    /**
     * @OA\Property(format="string", example="pixeles")
     */
    public ?string $source = null;
}
