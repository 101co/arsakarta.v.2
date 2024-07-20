<?php

namespace App\Filament\Resources\DigitalInvitation\Setting\PackageFeatureResource\Pages;

use App\Enums\Icons;
use Illuminate\Support\Js;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\DigitalInvitation\Setting\PackageFeatureResource;

class EditPackageFeature extends EditRecord
{
    protected static string $resource = PackageFeatureResource::class;

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
