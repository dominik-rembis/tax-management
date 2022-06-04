<?php

declare(strict_types=1);

namespace App\Core\Service;

class Property
{
    public static function set(object|string $object, string $property, mixed $value): void
    {
        (new \ReflectionClass($object))->getProperty($property)->setValue($object, $value);
    }
}