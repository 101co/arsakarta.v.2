<?php

namespace App\Filament\Resources\DigitalInvitation\Master\SongResource\Pages;

use Illuminate\Contracts\Support\Htmlable;
use Filament\Resources\Pages\ManageRecords;
use App\Filament\Resources\DigitalInvitation\Master\SongResource;

class ManageSongs extends ManageRecords
{
    protected static string $resource = SongResource::class;

    public function getTitle(): string | Htmlable
    {
        return __('');
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}
