<?php

namespace App\Enum;
use Illuminate\Database\Eloquent\Relations\Relation;
enum NotificationEnum :string

{case ALL = 'all';
    case USER = 'user';
    case PROVIDER = 'provider';

    
}
