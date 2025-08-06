<?php

namespace App\Enum;

enum stateStatusEnum: string
{
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';

    public function color(): string
    {
        return match ($this) {
            self::ACTIVE => 'success',
            self::INACTIVE => 'danger',
        };
    }

    public static function toArray(): array
    {
        return array_map(fn($case) => $case->value, self::cases());
    }
}
