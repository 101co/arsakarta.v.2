<?php

namespace App\Filament\Clusters\AssetManagement;

use App\Enums\Icons;
use Filament\Clusters\Cluster;

class Transaction extends Cluster
{
    protected static ?string $slug = 'astmt';
    protected static ?string $navigationGroup = 'Asset Management';
    protected static ?string $navigationIcon = Icons::TRANSACTION->value;
}
