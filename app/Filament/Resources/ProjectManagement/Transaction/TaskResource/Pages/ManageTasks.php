<?php

namespace App\Filament\Resources\ProjectManagement\Transaction\TaskResource\Pages;

use Illuminate\Contracts\Support\Htmlable;
use Filament\Resources\Pages\ManageRecords;
use App\Filament\Resources\ProjectManagement\Transaction\TaskResource;

class ManageTasks extends ManageRecords
{
    protected static string $resource = TaskResource::class;

    public function getTitle(): string | Htmlable
    {
        return __('');
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}
