<?php

namespace App\DTO\Resources;

use Spatie\LaravelData\Data;

/**
 * @OA\Schema(
 *     schema="User",
 *     description="User info"
 * )
 */

class UserDTO extends Data
{
    /**
     * @var integer
     * @OA\Property(format="string", example="23")
     */
    public int $id;

    /**
     * @var string
     * @OA\Property(format="string", example="Mihail")
     */
    public string $name;

    /**
     * @var string
     * @OA\Property(format="string", example="mihail23@gmail.com")
     */
    public string $email;

    /**
     * @var bool
     * @OA\Property(format="bool", example="true")
     */
    public bool $vip;

    //todo: проверить что этот ключ преобразуется из бд правильно в кемел кейс
    /**
     * @var bool
     * @OA\Property(format="bool", example="true")
     */
    public bool $autoChangerEnabled;
}
