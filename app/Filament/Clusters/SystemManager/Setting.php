<?php

namespace App\Filament\Clusters\SystemManager;

use App\Enums\Icons;
use Filament\Clusters\Cluster;

class Setting extends Cluster
{
    protected static ?string $slug = 'arskx';
    protected static ?string $navigationGroup = 'System Manager';
    protected static ?string $navigationIcon = Icons::SETTING->value;
}
