<?php

declare(strict_types=1);

namespace App\Core\Exception;

class ValidatorNotSupportModel extends \Exception
{
    private const MESSAGE = 'validator not support model: %s';

    public function __construct(string $model)
    {
        parent::__construct(sprintf(self::MESSAGE, $model), 500);
    }
}