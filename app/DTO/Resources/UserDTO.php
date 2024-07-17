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
     * @OA\Property(format="string", example="23")
     */
    public int $id;

    /**
     * @OA\Property(format="bool", example="true")
     */
    public bool $vip;

    //todo: проверить что этот ключ преобразуется из бд правильно в кемел кейс
    /**
     * @OA\Property(format="bool", example="true")
     */
    public bool $autoChangerEnabled;
}
