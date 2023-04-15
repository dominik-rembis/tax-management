<?php

declare(strict_types=1);

namespace App\Invoice\Data\ObjectValue;

class Release
{
    public function __construct(
        public string $place,
        public \DateTimeImmutable $date
    ) {}
}