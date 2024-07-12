<?php

namespace App\Filament\Resources\AssetManagement\Master\AssetTypeResource\Pages;

use App\Filament\Resources\AssetManagement\Master\AssetTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageAssetTypes extends ManageRecords
{
    protected static string $resource = AssetTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
