<?php

declare(strict_types=1);

namespace App\User\Data\Model;

use App\Core\Util\Trait\Timestamp;
use App\User\Permission\Model\UserPermission;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserData implements UserInterface, PasswordAuthenticatedUserInterface
{
    use Timestamp;

    private ?int $id = null;

    private string $name;

    private string $surname;

    private string $email;

    private ?string $password;

    private Collection $permissions;

    public function __construct()
    {
        $this->permissions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): self
    {
        $this->surname = $surname;
        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getUserIdentifier(): string
    {
        return $this->email;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    public function eraseCredentials(): self
    {
        $this->password = null;
        return $this;
    }

    public function getRoles(): array
    {
        return ["ROLE_USER"];
//        return array_map(
//            fn($permission) => $permission->getName(),
//            $this->permissions->toArray()
//        );
    }

    public function setRoles(UserPermission ...$permissions): self
    {
        foreach ($permissions as $permission) {
            if (!$this->permissions->contains($permission)) {
                $this->permissions[] = $permission;
            }
        }

        return $this;
    }
}
