<?php

namespace App\Filament\Resources\SystemManager\Master\ModuleResource\Pages;

use App\Filament\Resources\SystemManager\Master\ModuleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListModules extends ListRecords
{
    protected static string $resource = ModuleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
