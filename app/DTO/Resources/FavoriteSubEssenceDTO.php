<?php

namespace App\DTO\Resources;

use Spatie\LaravelData\Data;

/**
 * @OA\Schema(
 *     schema="FavoriteSubEssence",
 *     type="object",
 *     description="Favorite sub-essence data"
 * )
 */
class FavoriteSubEssenceDTO extends Data
{
    /**
     * @OA\Property(format="string", example="123")
     */
    public int $id;

    /**
     * @OA\Property(format="string", example="Cats")
     */
    public string $name;

    /**
     * @OA\Property(format="string", example="http://domain/storage/images/cats.jpg")
     */
    public string $image;

    /**
     * @OA\Property(format="integer", example="15")
     */
    public int $productsCount;

    public function __construct(int $id, string $name, string $image, int $productsCount)
    {
        $this->id = $id;
        $this->name = $name;
        $this->image = $image;
        $this->productsCount = $productsCount;
    }
}
