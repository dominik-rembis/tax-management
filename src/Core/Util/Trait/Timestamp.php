<?php

declare(strict_types=1);

namespace App\Core\Util\Trait;

use DateTimeImmutable;

trait Timestamp
{
    private ?DateTimeImmutable $updatedAt = null;

    private DateTimeImmutable $createdAt;

    public function getUpdatedAt(): ?DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }
}