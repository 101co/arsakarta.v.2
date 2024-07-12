<?php

namespace App\Filament\Clusters\SystemManager;

use Filament\Clusters\Cluster;

class Master extends Cluster
{
    protected static ?string $slug = 'sys-man-master';
    protected static ?string $navigationGroup = 'System Manager';
    protected static ?string $navigationIcon = 'heroicon-o-computer-desktop';
}
