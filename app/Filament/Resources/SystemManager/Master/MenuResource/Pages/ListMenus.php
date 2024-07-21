<?php

namespace App\Filament\Resources\SystemManager\Master\MenuResource\Pages;

use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;
use App\Filament\Resources\SystemManager\Master\MenuResource;

class ListMenus extends ListRecords
{
    protected static string $resource = MenuResource::class;

    public function getTitle(): string | Htmlable
    {
        return __('');
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}
