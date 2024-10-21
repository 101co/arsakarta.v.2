<?php

namespace App\Filament\Resources\DigitalInvitation\Master\ThemeCategoryResource\Pages;

use Illuminate\Contracts\Support\Htmlable;
use Filament\Resources\Pages\ManageRecords;
use App\Filament\Resources\DigitalInvitation\Master\ThemeCategoryResource;

class ManageThemeCategories extends ManageRecords
{
    protected static string $resource = ThemeCategoryResource::class;

    public function getTitle(): string | Htmlable
    {
        return __('');
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}
