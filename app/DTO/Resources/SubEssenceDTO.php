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
     * @var integer
     * @OA\Property(format="string", example="123")
     */
    public int $id;

    /**
     * @var string
     * @OA\Property(format="string", example="Cats")
     */
    public string $name;

    /**
     * @var string
     * @OA\Property(format="string", example="http://domain/storage/images/cats.jpg")
     */
    public string $image;

    /**
     * @var integer
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
