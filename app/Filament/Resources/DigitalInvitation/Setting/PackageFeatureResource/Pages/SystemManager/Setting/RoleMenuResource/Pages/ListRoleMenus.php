<?php

namespace App\Filament\Resources\SystemManager\Setting\RoleMenuResource\Pages;

use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;
use App\Filament\Resources\SystemManager\Setting\RoleMenuResource;

class ListRoleMenus extends ListRecords
{
    protected static string $resource = RoleMenuResource::class;

    public function getTitle(): string | Htmlable
    {
        return __('');
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}
