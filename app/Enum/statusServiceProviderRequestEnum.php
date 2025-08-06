<?php

namespace App\Enum;

use Filament\Support\Colors\Color;

enum statusServiceProviderRequestEnum : string
{

    case  PENDING =  'pending' ;
    case APPROVED ='approved';

    case REJECTED = 'rejected' ;
    public static function toArray(): array
{
    return array_column(self::cases(), 'value', 'value');
}

 public function color(){
       return match ($this){
        self::PENDING => Color::Green,
         self::APPROVED => Color::Red,
            self::REJECTED => Color::Blue,
       };
    }
}
