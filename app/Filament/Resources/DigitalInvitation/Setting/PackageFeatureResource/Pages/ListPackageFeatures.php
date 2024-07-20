<?php

namespace App\Filament\Resources\DigitalInvitation\Setting\PackageFeatureResource\Pages;

use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;
use App\Filament\Resources\DigitalInvitation\Setting\PackageFeatureResource;

class ListPackageFeatures extends ListRecords
{
    protected static string $resource = PackageFeatureResource::class;

    public function getTitle(): string | Htmlable
    {
        return __('');
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}
