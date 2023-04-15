<?php

declare(strict_types=1);

namespace App\Company\ObjectValue;

class BankAccountNumber
{
    public function __construct(
        public readonly string $iban,
        public readonly string $number
    ) {}

    public function __toString(): string
    {
        return sprintf(
            '%s %s',
            $this->iban,
            preg_replace(pattern: '/(\d{2})(\d{2})/', replacement: '$1 $2', subject: $this->number)
        );
    }
}