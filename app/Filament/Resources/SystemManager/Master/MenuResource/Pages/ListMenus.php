<?php

namespace App\Filament\Resources\SystemManager\Master\MenuResource\Pages;

use App\Filament\Resources\SystemManager\Master\MenuResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMenus extends ListRecords
{
    protected static string $resource = MenuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
