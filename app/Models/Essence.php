<?php

namespace App\Models;

use App\Enum\EssenceDisplayTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Essence extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function subEssences(): HasMany
    {
        return $this->hasMany(SubEssence::class);
    }
}
