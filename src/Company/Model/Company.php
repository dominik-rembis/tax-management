<?php

declare(strict_types=1);

namespace App\Company\Model;

use App\Company\ObjectValue\Address;
use App\Company\ObjectValue\BankAccountNumber;
use App\Core\Util\Trait\Timestamp;

class Company
{
    use Timestamp;

    private ?int $id = null;

    private string $name;

    private Address $address;

    private BankAccountNumber $bankAccount;

    private string $nip;

    private ?string $regon = null;

    private ?string $comments;

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

    public function getAddress(): Address
    {
        return $this->address;
    }

    public function setAddress(Address $address): self
    {
        $this->address = $address;
        return $this;
    }

    public function getBankAccount(): BankAccountNumber
    {
        return $this->bankAccount;
    }

    public function setBankAccount(BankAccountNumber $bankAccount): self
    {
        $this->bankAccount = $bankAccount;
        return $this;
    }

    public function getNip(): string
    {
        return $this->nip;
    }

    public function setNip(string $nip): self
    {
        $this->nip = $nip;
        return $this;
    }

    public function getRegon(): ?string
    {
        return $this->regon;
    }

    public function setRegon(?string $regon): self
    {
        $this->regon = $regon;
        return $this;
    }

    public function getComments(): ?string
    {
        return $this->comments;
    }

    public function setComments(?string $comments): self
    {
        $this->comments = $comments;
        return $this;
    }
}