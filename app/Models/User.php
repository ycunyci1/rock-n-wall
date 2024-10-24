<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guarded = ['id'];

    public function favorites(): HasMany
    {
        return $this->hasMany(Favorite::class);
    }

    public function autoChanger(): HasOne
    {
        return $this->hasOne(AutoChanger::class);
    }
}
