<?php

declare(strict_types=1);

namespace App\Company\ObjectValue;

class BankAccountNumber
{
    public function __construct(
        private string $iban,
        private string $number
    ) {}

    public function getIban(): string
    {
        return $this->iban;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function __toString(): string
    {
        return $this->iban . $this->number;
    }
}