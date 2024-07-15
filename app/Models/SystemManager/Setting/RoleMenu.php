<?php

namespace App\Models\SystemManager\Setting;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use App\Models\SystemManager\Master\Menu;
use App\Models\SystemManager\Master\Role;
use App\Models\SystemManager\Setting\RoleMenuUser;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\SystemManager\Setting\RoleMenuDetail;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class RoleMenu extends Model
{
    use HasFactory;

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function roleMenuDetails()
    {
        return $this->hasMany(RoleMenuDetail::class);
    }

    public function roleMenuUsers()
    {
        return $this->hasMany(RoleMenuUser::class);
    }
}
