<?php

namespace App\Filament\Resources\ProjectManagement\Master\ProjectResource\Pages;

use App\Filament\Resources\ProjectManagement\Master\ProjectResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProject extends CreateRecord
{
    protected static string $resource = ProjectResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = auth()->user()->username;
        $data['updated_by'] = auth()->user()->username;
        return $data;
    }
}
