<?php

namespace App\Filament\Resources\DigitalInvitation\Transaction\InvitationResource\Pages;

use App\Filament\Resources\DigitalInvitation\Transaction\InvitationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInvitations extends ListRecords
{
    protected static string $resource = InvitationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
