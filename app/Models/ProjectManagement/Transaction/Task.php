<?php

namespace App\Models\ProjectManagement\Transaction;

use Illuminate\Database\Eloquent\Model;
use App\Models\ProjectManagement\Master\Project;
use App\Models\ProjectManagement\Master\TaskType;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Log;

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

    public function startOrEndTask(Task $task, bool $isStopTask)
    {
        try 
        {
            $type = '';

            if (!$isStopTask)
            {
                // get task lain yang masih berjalan
                Task::where('status', '<>', 'complete')
                    ->where('status', '=', 'inprogress')
                    ->update(['status' => 'pending', 'updated_by' => auth()->user()->username]);
            }
            
            if ($task->status == 'notstarted' || $task->status == 'pending' && !$isStopTask) 
            {
                if ($task->status == 'notstarted')
                {
                    $task->actual_start_date = now();
                }

                $type = 'started';
                $task->status = 'inprogress';
                $task->updated_by = auth()->user()->username;
            }
            else if ($task->status == 'inprogress' || $task->status == 'pending')
            {
                if (!$isStopTask)
                {
                    $type = 'pending';
                    $task->status = 'pending';
                    $task->updated_by = auth()->user()->username;
                }
                else
                {
                    $type = 'finished';
                    $task->actual_end_date = now();
                    $task->status = 'complete';
                    $task->updated_by = auth()->user()->username;
                }
            }

            $task->save();
            Notification::make()
                ->title('Task '.$type.' successfully ')
                ->success()
                ->send();
        } 
        catch (\Throwable $th) 
        {
            Notification::make()
                ->title("Failed to save data")
                ->danger()
                ->send();
            Log::error($th);
        }
    }
}
