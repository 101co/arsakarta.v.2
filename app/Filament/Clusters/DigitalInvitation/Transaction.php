<?php

namespace App\Filament\Clusters\DigitalInvitation;

use App\Enums\Icons;
use Filament\Clusters\Cluster;

class Transaction extends Cluster
{
    protected static ?string $slug = 'invtt';
    protected static ?string $navigationGroup = 'Digital Invitation';
    protected static ?string $navigationIcon = Icons::TRANSACTION->value;
}
