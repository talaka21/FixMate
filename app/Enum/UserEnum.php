<?php

namespace App\Enum;

use Filament\Support\Colors\Color;

enum UserEnum : string
{
      case ACTIVE = 'active';
    case INACTIVE = 'inactive';
case SUSPENDED = 'suspended';

 public function color(){
       return match ($this){
        self::ACTIVE => Color::Green,
         self::INACTIVE => Color::Red,
            self::SUSPENDED => Color::Blue,
       };
    }
}
