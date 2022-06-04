<?php

declare(strict_types=1);

namespace App\Invoice\Data\ObjectValue;

class Release
{
    public function __construct(
        private string $place,
        private \DateTimeImmutable $date
    ) {}

    public function getPlace(): string
    {
        return $this->place;
    }

    public function getDate(): \DateTimeImmutable
    {
        return $this->date;
    }
}