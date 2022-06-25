<?php

declare(strict_types=1);

namespace App\Company\Util\Validator;

use Symfony\Component\Validator\Constraint;

final class VatIdentifier extends Constraint
{
    private string $message = 'The nip {{ nip }} is not valid.';

    public function getTargets(): string
    {
        return self::PROPERTY_CONSTRAINT;
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}
