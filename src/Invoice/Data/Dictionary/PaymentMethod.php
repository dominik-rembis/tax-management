<?php

declare(strict_types=1);

namespace App\Invoice\Data\Dictionary;

enum PaymentMethod: string
{
    case TRANSFER = 'TRANSFER';
    case CASH = 'CASH';

    public static function values(): array
    {
        return array_map(fn(self $case): string => $case->value, self::cases());
    }
}