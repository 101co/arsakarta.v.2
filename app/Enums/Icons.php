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

    // menu icons object
    case GENERAL = 'heroicon-o-swatch';
    case TICKET = 'heroicon-o-ticket';
    case PROMO = 'heroicon-o-percent-badge';
    case BRUSH = 'heroicon-o-paint-brush';
    case TWO_PEOPLE = 'heroicon-o-users';
    case GEAR = 'heroicon-o-cog-8-tooth';
    case CHAT = 'heroicon-o-chat-bubble-bottom-center-text';
    case MUSIC = 'heroicon-o-musical-note';
    case V_MARK = 'heroicon-o-check';
    case X_MARK = 'heroicon-o-x-mark';
    case INFO = 'heroicon-o-information-circle';
    case PLAY = 'heroicon-o-play';
    case STOP = 'heroicon-o-stop';
    case PAUSE = 'heroicon-o-pause';
}
