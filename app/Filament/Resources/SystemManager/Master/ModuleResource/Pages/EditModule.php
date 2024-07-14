<?php

namespace App\Filament\Resources\SystemManager\Master\ModuleResource\Pages;

use App\Enums\Icons;
use Illuminate\Support\Js;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\SystemManager\Master\ModuleResource;

class EditModule extends EditRecord
{
    protected static string $resource = ModuleResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getFormActions(): array
    {
        return 
        [
            getCustomCreateFormAction('Update', Icons::CHECK),
            getCustomCancelFormAction('Cancel', Icons::CROSS, Js::from($this->previousUrl ?? static::getResource()::getUrl()))
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['updated_by'] = auth()->user()->name;
        return $data;
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}
