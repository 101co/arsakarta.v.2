<?php

namespace App\Filament\Resources\HotWheels\Master\HotWheelsLotResource\Pages;

use Illuminate\Contracts\Support\Htmlable;
use Filament\Resources\Pages\ManageRecords;
use App\Filament\Resources\HotWheels\Master\HotWheelsLotResource;

class ManageHotWheelsLots extends ManageRecords
{
    protected static string $resource = HotWheelsLotResource::class;

    public function getTitle(): string | Htmlable
    {
        return __('');
    }
    
    protected function getHeaderActions(): array
    {
        return [];
    }
}
