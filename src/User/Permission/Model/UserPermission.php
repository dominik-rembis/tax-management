<?php

declare(strict_types=1);

namespace App\User\Permission\Model;

use App\Core\Util\Trait\Timestamp;

class UserPermission
{
    use Timestamp;

    private ?int $id = null;

    public function __construct(
        protected string $name
    ) {}

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }
}