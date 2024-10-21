<?php

namespace App\Filament\Resources\DigitalInvitation\Master\LayoutResource\Pages;

use Illuminate\Contracts\Support\Htmlable;
use Filament\Resources\Pages\ManageRecords;
use App\Filament\Resources\DigitalInvitation\Master\LayoutResource;

class ManageLayouts extends ManageRecords {
    protected static string $resource = LayoutResource::class;

    public function getTitle(): string | Htmlable {
        return __('');
    }

    protected function getHeaderActions(): array {
        return [];
    }
}
