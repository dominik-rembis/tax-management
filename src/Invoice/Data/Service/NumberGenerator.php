<?php

declare(strict_types=1);

namespace App\Invoice\Data\Service;

use App\Invoice\Data\ObjectValue\Number;
use App\Invoice\Data\Repository\InvoiceDataRepository;

class NumberGenerator
{
    public function __construct(
        private InvoiceDataRepository $repository
    ) {}

    public function generate(): Number
    {
        $lastId = $this->repository->findLastInvoiceNumber()?->getId() ?? 0;
        $dateTime = new \DateTimeImmutable();

        return new Number(
            (string) ($lastId + 1),
            $dateTime->format('m'),
            $dateTime->format('Y')
        );
    }
}