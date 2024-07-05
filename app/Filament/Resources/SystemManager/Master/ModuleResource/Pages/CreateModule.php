<?php

namespace App\Filament\Resources\SystemManager\Master\ModuleResource\Pages;

use App\Filament\Resources\SystemManager\Master\ModuleResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateModule extends CreateRecord
{
    protected static string $resource = ModuleResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = auth()->user()->name;
        $data['updated_by'] = auth()->user()->name;
    
        return $data;
    }
}
