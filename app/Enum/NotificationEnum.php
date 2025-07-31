<?php

namespace App\Enum;

enum NotificationEnum :string
{

    case  ALL = 'all';
    case USER ='user';
    case PROVIDER = 'provider';
}
