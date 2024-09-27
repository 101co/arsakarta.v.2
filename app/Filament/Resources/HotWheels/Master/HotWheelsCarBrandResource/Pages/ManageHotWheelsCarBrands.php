<?php

namespace App\Filament\Resources\HotWheels\Master\HotWheelsCarBrandResource\Pages;

use Illuminate\Contracts\Support\Htmlable;
use Filament\Resources\Pages\ManageRecords;
use App\Filament\Resources\HotWheels\Master\HotWheelsCarBrandResource;

class ManageHotWheelsCarBrands extends ManageRecords
{
    protected static string $resource = HotWheelsCarBrandResource::class;

    public function getTitle(): string | Htmlable
    {
        return __('');
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}
