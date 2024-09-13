<?php

namespace App\Filament\Clusters\ProjectManagement;

use App\Enums\Icons;
use Filament\Clusters\Cluster;

class Master extends Cluster
{
    protected static ?string $slug = 'prmgm';
    protected static ?string $navigationGroup = 'Project Management';
    protected static ?string $navigationIcon = Icons::MASTER->value;
}
