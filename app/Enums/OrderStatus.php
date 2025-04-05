<?php

namespace App\Enums;

enum OrderStatus: string
{
    case PENDING = 'pending';
    case IN_PROGRESS = 'in_progress';
    case COMPLETED = 'completed';
    case CANCELLED = 'cancelled';

    public static function toArray()
    {
        return collect(static::cases())
            ->mapWithKeys(function ($case) {
                return [$case->name => $case->value];
            })
            ->toArray();
    }
}
