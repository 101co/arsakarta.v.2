<?php

namespace App\Models\ProjectManagement\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    public function projectMembers()
    {
        return $this->hasMany(ProjectMember::class);
    }
}
