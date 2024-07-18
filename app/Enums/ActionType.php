<?php

namespace App\Enums;

enum ActionType: string
{
    case CREATE = 'CREATE';
    case EDIT = 'EDIT';
    case DELETE = 'DELETE';
    case BULK_DELETE = 'BULK_DELETE';
}
