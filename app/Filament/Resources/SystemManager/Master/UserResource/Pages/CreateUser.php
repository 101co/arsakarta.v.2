<?php

namespace App\Filament\Resources\SystemManager\Master\UserResource\Pages;

use App\Filament\Resources\SystemManager\Master\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = auth()->user()->name;
        $data['updated_by'] = auth()->user()->name;
    
        return $data;
    }
}
