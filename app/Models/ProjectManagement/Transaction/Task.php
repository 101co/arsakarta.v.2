<?php

namespace App\Models\ProjectManagement\Transaction;

use Illuminate\Database\Eloquent\Model;
use App\Models\ProjectManagement\Master\Project;
use App\Models\ProjectManagement\Master\TaskType;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function taskType()
    {
        return $this->belongsTo(TaskType::class);
    }
}
