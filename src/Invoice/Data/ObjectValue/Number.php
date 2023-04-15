<?php

declare(strict_types=1);

namespace App\Invoice\Data\ObjectValue;

class Number
{
    public function __construct(
        public readonly string $id,
        public readonly string $month,
        public readonly string $year
    ) {}

    public function getNumber(): string
    {
        return sprintf('%s/%s/%s', $this->id, $this->month, $this->year);
    }

    public function __toString(): string
    {
        return $this->getNumber();
    }
}