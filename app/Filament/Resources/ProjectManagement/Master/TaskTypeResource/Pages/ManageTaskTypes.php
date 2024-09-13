<?php

namespace App\Filament\Resources\ProjectManagement\Master\TaskTypeResource\Pages;

use Illuminate\Contracts\Support\Htmlable;
use Filament\Resources\Pages\ManageRecords;
use App\Filament\Resources\ProjectManagement\Master\TaskTypeResource;

class ManageTaskTypes extends ManageRecords
{
    protected static string $resource = TaskTypeResource::class;

    public function getTitle(): string | Htmlable
    {
        return __('');
    }

    protected function getHeaderActions(): array
    {
        return [
        ];
    }
}
