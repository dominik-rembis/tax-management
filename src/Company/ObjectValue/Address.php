<?php

declare(strict_types=1);

namespace App\Company\ObjectValue;

class Address
{
    public function __construct(
        private readonly string $street,
        private readonly string $zipCode,
        private readonly string $city,
        private readonly string $country
    ) {}

    public function getStreet(): string
    {
        return $this->street;
    }

    public function getZipCode(): string
    {
        return $this->zipCode;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getCountry(): string
    {
        return $this->country;
    }
}