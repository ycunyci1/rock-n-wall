<?php

namespace App\DTO\Resources;

use Spatie\LaravelData\Data;

/**
 * @OA\Schema(
 *     schema="SubEssence",
 *     description="Sub essence data"
 * )
 */
class SubEssenceDTO extends Data
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

    /**
     * @OA\Property(format="string", example="15")
     */
    public string $displayType;

    public function __construct(int $id, string $name, string $image, int $productsCount, string $displayType)
    {
        $this->id = $id;
        $this->name = $name;
        $this->image = $image;
        $this->productsCount = $productsCount;
        $this->displayType = $displayType;
    }
}
