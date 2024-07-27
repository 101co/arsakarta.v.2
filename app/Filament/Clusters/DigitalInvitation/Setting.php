<?php

namespace App\Filament\Clusters\DigitalInvitation;

use App\Enums\Icons;
use Filament\Clusters\Cluster;

class Setting extends Cluster
{
    protected static ?string $slug = 'invtx';
    protected static ?string $navigationGroup = 'Digital Invitation';
    protected static ?string $navigationIcon = Icons::SETTING->value;
}
