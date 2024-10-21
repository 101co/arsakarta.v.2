<?php

namespace App\Filament\Resources\DigitalInvitation\Setting\PackageFeatureResource\Pages;

use App\Enums\Icons;
use Illuminate\Support\Js;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\DigitalInvitation\Setting\PackageFeatureResource;

class CreatePackageFeature extends CreateRecord
{
    protected static string $resource = PackageFeatureResource::class;
    protected static ?string $title = 'Setting Event Type Layout';

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getFormActions(): array
    {
        return 
        [
            getCustomCreateFormAction('Save', Icons::CHECK),
            getCustomCreateAnotherFormAction('Save & Add Other', Icons::CHECK),
            getCustomCancelFormAction('Cancel', Icons::CROSS, Js::from($this->previousUrl ?? static::getResource()::getUrl()))
        ];
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = auth()->user()->username;
        $data['updated_by'] = auth()->user()->username;
        return $data;
    }
}
