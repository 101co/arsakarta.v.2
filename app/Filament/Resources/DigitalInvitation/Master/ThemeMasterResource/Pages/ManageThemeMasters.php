<?php

namespace App\Filament\Resources\DigitalInvitation\Master\ThemeMasterResource\Pages;

use Illuminate\Contracts\Support\Htmlable;
use Filament\Resources\Pages\ManageRecords;
use App\Filament\Resources\DigitalInvitation\Master\ThemeMasterResource;

class ManageThemeMasters extends ManageRecords {
    protected static string $resource = ThemeMasterResource::class;

    public function getTitle(): string | Htmlable {
        return __('');
    }

    protected function getHeaderActions(): array {
        return [];
    }
}
