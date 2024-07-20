<?php

namespace App\Filament\Resources\DigitalInvitation\Master\FeatureResource\Pages;

use Illuminate\Contracts\Support\Htmlable;
use Filament\Resources\Pages\ManageRecords;
use App\Filament\Resources\DigitalInvitation\Master\FeatureResource;

class ManageFeatures extends ManageRecords
{
    protected static string $resource = FeatureResource::class;

    public function getTitle(): string | Htmlable
    {
        return __('');
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}
