<?php

namespace App\Filament\Resources\HotWheels\Master\HotWheelsTypeResource\Pages;

use Illuminate\Contracts\Support\Htmlable;
use Filament\Resources\Pages\ManageRecords;
use App\Filament\Resources\HotWheels\Master\HotWheelsTypeResource;

class ManageHotWheelsTypes extends ManageRecords
{
    protected static string $resource = HotWheelsTypeResource::class;

    public function getTitle(): string | Htmlable
    {
        return __('');
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}
