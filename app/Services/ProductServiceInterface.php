<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;

interface ProductServiceInterface
{
    public function getMainPageInfo(): array;
    public function getLiveImages(): Collection;

    public function getCategories(): Collection;

}
