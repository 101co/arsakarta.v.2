<?php

namespace App\Filament\Resources\AssetManagement\Master\AssetResource\Pages;

use Filament\Actions;
use Illuminate\Contracts\Support\Htmlable;
use Filament\Resources\Pages\ManageRecords;
use App\Filament\Resources\AssetManagement\Master\AssetResource;

class ManageAssets extends ManageRecords
{
    protected static string $resource = AssetResource::class;

    public function getTitle(): string | Htmlable
    {
        return '';
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}
