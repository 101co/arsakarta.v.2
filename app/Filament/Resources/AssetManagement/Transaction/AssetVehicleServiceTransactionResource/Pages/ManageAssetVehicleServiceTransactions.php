<?php

namespace App\Filament\Resources\AssetManagement\Transaction\AssetVehicleServiceTransactionResource\Pages;

use Illuminate\Contracts\Support\Htmlable;
use Filament\Resources\Pages\ManageRecords;
use App\Filament\Resources\AssetManagement\Transaction\AssetVehicleServiceTransactionResource;

class ManageAssetVehicleServiceTransactions extends ManageRecords
{
    protected static string $resource = AssetVehicleServiceTransactionResource::class;

    public function getTitle(): string|Htmlable
    {
        return '';
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}
