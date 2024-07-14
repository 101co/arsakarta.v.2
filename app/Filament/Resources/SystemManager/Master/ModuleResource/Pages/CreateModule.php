<?php

namespace App\Filament\Resources\SystemManager\Master\ModuleResource\Pages;

use App\Enums\Icons;
use Illuminate\Support\Js;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\SystemManager\Master\ModuleResource;
use PhpParser\Node\Expr\Cast\String_;

class CreateModule extends CreateRecord
{
    protected static string $resource = ModuleResource::class;
    protected static ?string $title = 'Add Module';

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getFormActions(): array
    {
        return 
        [
            getCustomCreateFormAction('Save', Icons::CHECK),
            getCustomCreateAnotherFormAction('Save & Add Other', Icons::CHECK),
            getCustomCancelFormAction('Cancel', Icons::CROSS, Js::from($this->previousUrl ?? static::getResource()::getUrl()))
        ];
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = auth()->user()->name;
        $data['updated_by'] = auth()->user()->name;
        return $data;
    }
}
