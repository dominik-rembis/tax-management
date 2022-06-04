<?php

declare(strict_types=1);

namespace App\User\Permission\Repository;

use App\User\Permission\Model\UserPermission;
use Doctrine\ORM\EntityManagerInterface;

class UserPermissionRepository
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager
    ) {}

    public function findAll(): array
    {
        return $this->entityManager
            ->getRepository(UserPermission::class)
            ->findAll();
    }

    public function findAllNames(): array
    {
        $qb = $this->entityManager->createQueryBuilder();

        return $qb
            ->select('p.name')
            ->from(UserPermission::class, 'p')
            ->getQuery()
            ->getSingleColumnResult();
    }

    public function save(UserPermission ...$permissions): void
    {
        foreach ($permissions as $permission) {
            $this->entityManager->persist($permission);
        }

        $this->entityManager->flush();
    }
}