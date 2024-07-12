<?php

namespace App\Filament\Clusters\SystemManager;

use Filament\Clusters\Cluster;

class Setting extends Cluster
{
    protected static ?string $slug = 'sys-man-setting';
    protected static ?string $navigationGroup = 'System Manager';
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
}
