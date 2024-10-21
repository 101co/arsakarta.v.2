<?php

namespace App\Filament\Resources\DigitalInvitation\Setting\EventTypeLayoutResource\Pages;

use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;
use App\Filament\Resources\DigitalInvitation\Setting\EventTypeLayoutResource;

class ListEventTypeLayouts extends ListRecords
{
    protected static string $resource = EventTypeLayoutResource::class;

    public function getTitle(): string | Htmlable
    {
        return __('');
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}
