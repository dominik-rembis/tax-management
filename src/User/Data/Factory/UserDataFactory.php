<?php

declare(strict_types=1);

namespace App\User\Data\Factory;

use App\User\Data\Model\UserData;

class UserDataFactory
{
    public static function create(
        string $name,
        string $surname,
        string $email,
        string $password,
        array $permissions
    ): UserData
    {
        return (new UserData())
            ->setName($name)
            ->setSurname($surname)
            ->setEmail($email)
            ->setPassword($password)
            ->setRoles(...$permissions);
    }
}