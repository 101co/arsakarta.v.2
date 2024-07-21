<?php

namespace App\Enums;

enum Icons: string
{
    // button icons
    case CHECK = 'heroicon-c-check';
    case CROSS = 'heroicon-o-x-circle';
    case ADD = 'heroicon-c-plus-circle';
    case EDIT = 'heroicon-c-pencil-square';

    // menu icons
    case DEFAULT = 'heroicon-o-squares-2x2';
    case MASTER = 'heroicon-o-clipboard-document-list';
    case SETTING = 'heroicon-s-adjustments-vertical';
    case TRANSACTION = 'heroicon-o-wallet';
}
