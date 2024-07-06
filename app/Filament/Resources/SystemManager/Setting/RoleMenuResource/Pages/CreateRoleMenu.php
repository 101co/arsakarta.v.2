<?php

namespace App\Filament\Resources\SystemManager\Setting\RoleMenuResource\Pages;

use App\Filament\Resources\SystemManager\Setting\RoleMenuResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateRoleMenu extends CreateRecord
{
    protected static string $resource = RoleMenuResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = auth()->user()->name;
        $data['updated_by'] = auth()->user()->name;
    
        return $data;
    }
}
