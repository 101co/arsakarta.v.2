<?php

namespace App\Filament\Resources\DigitalInvitation\Master\ThemeResource\Pages;

use Illuminate\Contracts\Support\Htmlable;
use Filament\Resources\Pages\ManageRecords;
use App\Filament\Resources\DigitalInvitation\Master\ThemeResource;

class ManageThemes extends ManageRecords
{
    protected static string $resource = ThemeResource::class;

    public function getTitle(): string | Htmlable {
        return __('');
    }

    protected function getHeaderActions(): array {
        return [];
    }
}
