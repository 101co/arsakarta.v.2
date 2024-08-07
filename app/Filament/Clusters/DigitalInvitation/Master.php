<?php

namespace App\Filament\Clusters\DigitalInvitation;

use App\Enums\Icons;
use Filament\Clusters\Cluster;

class Master extends Cluster
{
    protected static ?string $slug = 'invtm';
    protected static ?string $navigationGroup = 'Digital Invitation';
    protected static ?string $navigationIcon = Icons::MASTER->value;
}
