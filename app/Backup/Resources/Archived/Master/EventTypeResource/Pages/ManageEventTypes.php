<?php

namespace App\Filament\Resources\DigitalInvitation\Master\EventTypeResource\Pages;

use Illuminate\Contracts\Support\Htmlable;
use Filament\Resources\Pages\ManageRecords;
use App\Filament\Resources\DigitalInvitation\Master\EventTypeResource;

class ManageEventTypes extends ManageRecords
{
    protected static string $resource = EventTypeResource::class;

    public function getTitle(): string | Htmlable
    {
        return __('');
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}
