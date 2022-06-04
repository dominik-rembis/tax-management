<?php

declare(strict_types=1);

namespace App\Company\ObjectValue;

class Address
{
    public function __construct(
        private string $street,
        private string $zipCode,
        private string $city,
        private string $country
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