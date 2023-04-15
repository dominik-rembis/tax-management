<?php

declare(strict_types=1);

namespace App\Company\ObjectValue;

class Address
{
    public function __construct(
        public readonly string $street,
        public readonly string $zipCode,
        public readonly string $city,
        public readonly string $country
    ) {}
}