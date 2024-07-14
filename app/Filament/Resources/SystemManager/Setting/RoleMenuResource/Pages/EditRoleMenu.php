<?php

namespace App\Filament\Resources\SystemManager\Setting\RoleMenuResource\Pages;

use App\Enums\Icons;
use Illuminate\Support\Js;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\SystemManager\Setting\RoleMenuResource;

class EditRoleMenu extends EditRecord
{
    protected static string $resource = RoleMenuResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getFormActions(): array
    {
        return 
        [
            getCustomSaveFormAction('Update', Icons::CHECK),
            getCustomCancelFormAction('Cancel', Icons::CROSS, Js::from($this->previousUrl ?? static::getResource()::getUrl()))
        ];
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}
