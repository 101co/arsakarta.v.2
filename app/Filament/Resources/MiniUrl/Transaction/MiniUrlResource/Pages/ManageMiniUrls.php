<?php

namespace App\Filament\Resources\MiniUrl\Transaction\MiniUrlResource\Pages;

use Filament\Actions;
use Illuminate\Contracts\Support\Htmlable;
use Filament\Resources\Pages\ManageRecords;
use App\Filament\Resources\MiniUrl\Transaction\MiniUrlResource;

class ManageMiniUrls extends ManageRecords {
    protected static string $resource = MiniUrlResource::class;

    public function getTitle(): string | Htmlable {
        return __('');
    }

    protected function getHeaderActions(): array {
        return [];
    }
}
