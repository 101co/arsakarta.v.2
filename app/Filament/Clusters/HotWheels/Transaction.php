<?php

namespace App\Filament\Clusters\HotWheels;

use App\Enums\Icons;
use Filament\Clusters\Cluster;

class Transaction extends Cluster
{
    protected static ?string $slug = 'hotwheels-trans';
    protected static ?string $navigationGroup = 'Hot Wheels';
    protected static ?string $navigationIcon = Icons::MASTER->value;
}
