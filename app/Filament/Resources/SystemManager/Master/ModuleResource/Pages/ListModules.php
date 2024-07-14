<?php

namespace App\Filament\Resources\SystemManager\Master\ModuleResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;
use App\Filament\Resources\SystemManager\Master\ModuleResource;

class ListModules extends ListRecords
{
    protected static string $resource = ModuleResource::class;

    public function getTitle(): string | Htmlable
    {
        return __('');
    }

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
