<?php

namespace App\Models\SystemManager\Setting;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleMenuUser extends Model {
    use HasFactory;
    protected $table = 'sysmans_role_menu_user';

    // protected $casts = [
    //     'user_id' => 'array',
    // ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
