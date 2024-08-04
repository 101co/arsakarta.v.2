<?php

namespace App\Filament\Resources\AssetManagement\Transaction\PajakKendaraanResource\Pages;

use App\Filament\Resources\AssetManagement\Transaction\PajakKendaraanResource;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Contracts\Support\Htmlable;

class ManagePajakKendaraans extends ManageRecords
{
    protected static string $resource = PajakKendaraanResource::class;

    public function getTitle(): string|Htmlable
    {
        return '';
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}
