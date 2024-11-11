<?php

namespace App\Filament\Clusters\MiniUrl;

use App\Enums\Icons;
use Filament\Clusters\Cluster;

class Transaction extends Cluster
{
    protected static ?string $slug = 'miniurl';
    protected static ?string $navigationGroup = 'Mini Url';
    protected static ?string $navigationIcon = Icons::MASTER->value;
}
