<?php

namespace App\Filament\Resources\DigitalInvitation\Master\EventCategoryResource\Pages;

use Illuminate\Contracts\Support\Htmlable;
use Filament\Resources\Pages\ManageRecords;
use App\Filament\Resources\DigitalInvitation\Master\EventCategoryResource;

class ManageEventCategories extends ManageRecords
{
    protected static string $resource = EventCategoryResource::class;

    public function getTitle(): string | Htmlable
    {
        return __('');
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}
