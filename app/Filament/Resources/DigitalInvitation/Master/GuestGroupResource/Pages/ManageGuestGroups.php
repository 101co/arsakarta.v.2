<?php

namespace App\Filament\Resources\DigitalInvitation\Master\GuestGroupResource\Pages;

use Illuminate\Contracts\Support\Htmlable;
use Filament\Resources\Pages\ManageRecords;
use App\Filament\Resources\DigitalInvitation\Master\GuestGroupResource;

class ManageGuestGroups extends ManageRecords
{
    protected static string $resource = GuestGroupResource::class;

    public function getTitle(): string | Htmlable {
        return __('');
    }

    protected function getHeaderActions(): array {
        return [];
    }
}
