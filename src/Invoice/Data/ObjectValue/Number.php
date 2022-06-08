<?php

declare(strict_types=1);

namespace App\Invoice\Data\ObjectValue;

class Number
{
    public function __construct(
        private string $id,
        private string $month,
        private string $year
    ) {}
    
    public function getId(): int
    {
        return (int) $this->id;
    }

    public function getMonth(): int
    {
        return (int) $this->month;
    }

    public function getYear(): int
    {
        return (int) $this->year;
    }

    public function getNumber(): string
    {
        return sprintf('%s/%s/%s', $this->id, $this->month, $this->year);
    }

    public function __toString(): string
    {
        return $this->getNumber();
    }
}