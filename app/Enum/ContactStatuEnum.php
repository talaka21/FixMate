<?php

namespace App\Enum;

enum ContactStatuEnum :string
{
   case READ = 'read';
    case UNREAD = 'unread';
    case PENDING = 'pending';

}
