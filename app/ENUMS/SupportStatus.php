<?php

namespace App\ENUMS;

enum SupportStatus: string
{
    case OPEN = 'open';
    case CLOSED = 'closed';
    case PENDING = 'pending';

    public static function fromValue(string $value): SupportStatus
    {
        return match ($value) {
            'open' => self::OPEN,
            'closed' => self::CLOSED,
            'pending' => self::PENDING,
        };
    }
}
