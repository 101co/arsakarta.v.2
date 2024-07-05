<?php

namespace App\Filament\Resources\SystemManager\Setting\RoleMenuResource\Pages;

use App\Filament\Resources\SystemManager\Setting\RoleMenuResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRoleMenu extends EditRecord
{
    protected static string $resource = RoleMenuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
