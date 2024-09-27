<?php

namespace App\Filament\Resources\HotWheels\Transaction\HotWheelsMyCollectionResource\Pages;

use Illuminate\Contracts\Support\Htmlable;
use Filament\Resources\Pages\ManageRecords;
use App\Filament\Resources\HotWheels\Transaction\HotWheelsMyCollectionResource;

class ManageHotWheelsMyCollections extends ManageRecords
{
    protected static string $resource = HotWheelsMyCollectionResource::class;
    
    public function getTitle(): string | Htmlable
    {
        return __('');
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}
