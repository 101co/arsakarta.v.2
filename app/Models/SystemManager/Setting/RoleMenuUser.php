<?php

namespace App\Models\SystemManager\Setting;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleMenuUser extends Model
{
    use HasFactory;

    // protected $casts = [
    //     'user_id' => 'array',
    // ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
