<?php

namespace App\Invoice\Data\Repository;

use App\Invoice\Data\Model\InvoiceData;
use App\Invoice\Data\ObjectValue\Number;
use Doctrine\ORM\EntityManagerInterface;

class InvoiceDataRepository
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager
    ) {}

    public function findLastInvoiceNumber(): ?Number
    {
        $qb = $this->entityManager->getRepository(InvoiceData::class);
        $result = $qb->createQueryBuilder('iD')
            ->select('iD.number')
            ->where('iD.createdAt >= :dateStart')
            ->andWhere('iD.createdAt <= :dateEnd')
            ->orderBy('iD.number', 'Desc')
            ->setMaxResults(1)
            ->setParameters([
                'dateStart' => new \DateTimeImmutable('first day of this month 00:00:00'),
                'dateEnd' => new \DateTimeImmutable('last day of this month 23:59:59')
            ])
            ->getQuery()
            ->getOneOrNullResult();

        return $result ? reset($result) : null;
    }
}