<?php

namespace App\Invoice\Data\Util\Orm\Type;

use App\Invoice\Data\ObjectValue\Number;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

final class NumberType extends Type
{
    private const INVOICE_NUMBER = 'invoice_number';

    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return $platform->getVarcharTypeDeclarationSQL($column);
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): Number
    {
        return new Number(...explode('/', $value));
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): string
    {
        return $value->getNumber();
    }

    public function getName(): string
    {
        return self::INVOICE_NUMBER;
    }
}