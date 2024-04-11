<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Orchid\Platform\Models\Role as OrchidRole;

class AdminRole extends OrchidRole
{
    protected $table = 'admin_roles';

    use HasFactory;

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Admin::class, 'admin_role', 'role_id', 'admin_id');
    }
}
