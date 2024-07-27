<?php

namespace App\Filament\Clusters\SystemManager;

use App\Enums\Icons;
use Filament\Clusters\Cluster;

class Master extends Cluster
{
    protected static ?string $slug = 'arskm';
    protected static ?string $navigationGroup = 'System Manager';
    protected static ?string $navigationIcon = Icons::MASTER->value;
}
