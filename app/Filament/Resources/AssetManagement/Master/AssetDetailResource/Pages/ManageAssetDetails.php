<?php

namespace App\Filament\Resources\AssetManagement\Master\AssetDetailResource\Pages;

use Illuminate\Contracts\Support\Htmlable;
use Filament\Resources\Pages\ManageRecords;
use App\Filament\Resources\AssetManagement\Master\AssetDetailResource;

class ManageAssetDetails extends ManageRecords
{
    protected static string $resource = AssetDetailResource::class;

    public function getTitle(): string | Htmlable
    {
        return __('');
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}
