<?php

namespace App\Models\SystemManager\Setting;

use Illuminate\Database\Eloquent\Model;
use App\Models\SystemManager\Master\Role;
use App\Models\SystemManager\Setting\RoleMenuUser;
use App\Models\SystemManager\Setting\RoleMenuDetail;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RoleMenu extends Model {
    use HasFactory;
    protected $table = 'sysmans_role_menu';

    public function role(): BelongsTo {
        return $this->belongsTo(Role::class);
    }

    public function roleMenuDetails() {
        return $this->hasMany(RoleMenuDetail::class);
    }

    public function roleMenuUsers() {
        return $this->hasMany(RoleMenuUser::class);
    }
}
