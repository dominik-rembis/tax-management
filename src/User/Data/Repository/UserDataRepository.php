<?php

declare(strict_types=1);

namespace App\User\Data\Repository;

use App\User\Data\Model\UserData;
use Doctrine\ORM\EntityManagerInterface;

class UserDataRepository
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager
    ) {}

    public function isUser(): bool
    {
        $qb = $this->entityManager->createQueryBuilder();

        $result = $qb
            ->select('COUNT(u.id) as userCount')
            ->from(UserData::class, 'u')
            ->getQuery()
            ->getOneOrNullResult();

        return $result['userCount'] > 0;
    }
    
    public function save(UserData $userData): void
    {
        $this->entityManager->persist($userData);
        $this->entityManager->flush();
    }
}