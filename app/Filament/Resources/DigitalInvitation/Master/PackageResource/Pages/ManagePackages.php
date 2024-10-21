<?php

namespace App\Filament\Resources\DigitalInvitation\Master\PackageResource\Pages;

use Illuminate\Contracts\Support\Htmlable;
use Filament\Resources\Pages\ManageRecords;
use App\Filament\Resources\DigitalInvitation\Master\PackageResource;

class ManagePackages extends ManageRecords {
    protected static string $resource = PackageResource::class;

    public function getTitle(): string | Htmlable {
        return __('');
    }

    protected function getHeaderActions(): array {
        return [];
    }
}
