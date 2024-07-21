<?php

namespace App\Filament\Clusters\AssetManagement;

use App\Enums\Icons;
use Filament\Clusters\Cluster;

class Master extends Cluster
{
    protected static ?string $slug = 'asset-management-master';
    protected static ?string $navigationGroup = 'Asset Management';
    protected static ?string $navigationIcon = Icons::MASTER->value;
}
