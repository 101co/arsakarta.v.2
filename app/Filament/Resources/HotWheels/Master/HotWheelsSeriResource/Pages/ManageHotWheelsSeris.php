<?php

namespace App\Filament\Resources\HotWheels\Master\HotWheelsSeriResource\Pages;

use Illuminate\Contracts\Support\Htmlable;
use Filament\Resources\Pages\ManageRecords;
use App\Filament\Resources\HotWheels\Master\HotWheelsSeriResource;

class ManageHotWheelsSeris extends ManageRecords
{
    protected static string $resource = HotWheelsSeriResource::class;

    public function getTitle(): string | Htmlable
    {
        return __('');
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}
