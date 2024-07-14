<?php

namespace App\Filament\Resources\SystemManager\Master\RoleResource\Pages;

use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;
use App\Filament\Resources\SystemManager\Master\RoleResource;

class ListRoles extends ListRecords
{
    protected static string $resource = RoleResource::class;

    public function getTitle(): string | Htmlable
    {
        return __('');
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}
