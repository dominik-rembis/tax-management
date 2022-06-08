<?php

declare(strict_types=1);

namespace App\Invoice\Data\Model;

use App\Company\Model\Company;
use App\Core\Util\Trait\Timestamp;
use App\Invoice\Data\ObjectValue\Number;
use App\Invoice\Data\Dictionary\PaymentMethod;
use App\Invoice\Data\ObjectValue\Release;
use App\Invoice\Item\Model\InvoiceItem;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class InvoiceData
{
    use Timestamp;

    private ?int $id = null;

    private ?Number $number = null;

    private DateTimeImmutable $paymentDeadline;

    private string $paymentMethod;

    private Release $release;

    private DateTimeImmutable $executeDate;

    private Company $seller;

    private Company $buyer;

    private Collection $invoiceItems;

    private ?string $comments;

    public function __construct()
    {
        $this->invoiceItems = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInvoiceNumber(): string
    {
        return $this->number->getNumber();
    }

    public function getNumber(): ?Number
    {
        return $this->number;
    }

    public function getPaymentDeadline(): DateTimeImmutable
    {
        return $this->paymentDeadline;
    }

    public function setPaymentDeadline(DateTimeImmutable $paymentDeadline): self
    {
        $this->paymentDeadline = $paymentDeadline;
        return $this;
    }

    public function getPaymentMethod(): PaymentMethod
    {
        return PaymentMethod::from($this->paymentMethod);
    }

    public function setPaymentMethod(string $paymentMethod): self
    {
        $this->paymentMethod = $paymentMethod;
        return $this;
    }

    public function getRelease(): Release
    {
        return $this->release;
    }

    public function setRelease(Release $release): self
    {
        $this->release = $release;
        return $this;
    }

    public function getExecuteDate(): DateTimeImmutable
    {
        return $this->executeDate;
    }

    public function setExecuteDate(DateTimeImmutable $executeDate): self
    {
        $this->executeDate = $executeDate;
        return $this;
    }

    public function getSeller(): Company
    {
        return $this->seller;
    }

    public function setSeller(Company $seller): self
    {
        $this->seller = $seller;
        return $this;
    }

    public function getBuyer(): Company
    {
        return $this->buyer;
    }

    public function setBuyer(Company $buyer): self
    {
        $this->buyer = $buyer;
        return $this;
    }

    public function getInvoiceItems(): mixed
    {
        return $this->invoiceItems;
    }

    /** @param InvoiceItem[] $invoiceItems */
    public function setInvoiceItems(array $invoiceItems): self
    {
        foreach ($invoiceItems as $invoiceItem) {
            if (!$this->invoiceItems->contains($invoiceItem)) {
                $this->invoiceItems[] = $invoiceItem
                    ->setInvoiceData($this);
            }
        }

        return $this;
    }

    public function getNetAmountSum(): float
    {
        return array_sum(
            array_map(
                fn($item) => $item->getNetAmount(),
                $this->invoiceItems->toArray()
            )
        );
    }

    public function getComments(): string
    {
        return $this->comments;
    }

    public function setComments(string $comments): self
    {
        $this->comments = $comments;
        return $this;
    }
}