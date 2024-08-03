<?php

namespace App\Filament\Resources\AssetManagement\Master\AssetTypeResource\Pages;

use Illuminate\Contracts\Support\Htmlable;
use Filament\Resources\Pages\ManageRecords;
use App\Filament\Resources\AssetManagement\Master\AssetTypeResource;

class ManageAssetTypes extends ManageRecords
{
    protected static string $resource = AssetTypeResource::class;

    public function getTitle(): string | Htmlable
    {
        return __('');
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}
