<?php

namespace App\Filament\Resources\DigitalInvitation\Master\LayoutResource\Pages;

use App\Filament\Resources\DigitalInvitation\Master\LayoutResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageLayouts extends ManageRecords
{
    protected static string $resource = LayoutResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
