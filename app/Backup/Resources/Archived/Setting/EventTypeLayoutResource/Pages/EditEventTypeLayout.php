<?php

namespace App\Filament\Resources\DigitalInvitation\Setting\EventTypeLayoutResource\Pages;

use App\Enums\Icons;
use Illuminate\Support\Js;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\DigitalInvitation\Setting\EventTypeLayoutResource;

class EditEventTypeLayout extends EditRecord
{
    protected static string $resource = EventTypeLayoutResource::class;

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
