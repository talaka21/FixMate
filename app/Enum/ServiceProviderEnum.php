<?php

namespace App\Enum;

use Filament\Support\Colors\Color;

enum ServiceProviderEnum :string
{
       case ACTIVE = 'active';
    case INACTIVE = 'inactive';
case EXPIRED = 'expired';

 public function color(){
       return match ($this){
        self::ACTIVE => Color::Green,
         self::INACTIVE => Color::Red,
            self::EXPIRED => Color::Blue,
       };
    }
}
