<?php

namespace App\Filament\Resources\DigitalInvitation\Master\LayoutThemePageResource\Pages;

use Illuminate\Contracts\Support\Htmlable;
use Filament\Resources\Pages\ManageRecords;
use App\Filament\Resources\DigitalInvitation\Master\LayoutThemePageResource;

class ManageLayoutThemePages extends ManageRecords {
    protected static string $resource = LayoutThemePageResource::class;

    public function getTitle(): string | Htmlable {
        return __('');
    }

    protected function getHeaderActions(): array {
        return [];
    }
}
