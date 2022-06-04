<?php

declare(strict_types=1);

namespace App\User\Data\Service;

class PasswordGenerator
{
    private const BYTES = 2;

    private string $password;

    public function __construct(int $length = 8)
    {
        $this->password = bin2hex(openssl_random_pseudo_bytes($length / self::BYTES));
    }

    public function getPlainPassword(): string
    {
        return $this->password;
    }

    public function getPasswordHash(): string
    {
        return password_hash($this->password, PASSWORD_ARGON2I);
    }
}