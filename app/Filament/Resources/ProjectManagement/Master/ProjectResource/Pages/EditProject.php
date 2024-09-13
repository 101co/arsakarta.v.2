<?php

namespace App\Filament\Resources\ProjectManagement\Master\ProjectResource\Pages;

use App\Enums\Icons;
use Filament\Actions;
use Illuminate\Support\Js;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\ProjectManagement\Master\ProjectResource;

class EditProject extends EditRecord
{
    protected static string $resource = ProjectResource::class;

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
