<?php

declare(strict_types=1);

namespace App\Invoice\Item\Model;

use App\Core\Util\Trait\Timestamp;
use App\Invoice\Data\Model\InvoiceData;

class InvoiceItem
{
    use Timestamp;

    private ?int $id = null;

    private ?InvoiceData $invoiceData = null;

    private string $name;

    private float $netAmount;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInvoiceData(): ?InvoiceData
    {
        return $this->invoiceData;
    }

    public function setInvoiceData(InvoiceData $invoiceData): self
    {
        $this->invoiceData = $invoiceData;
        return $this;
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

    public function getNetAmount(): float
    {
        return $this->netAmount;
    }

    public function setNetAmount(float $netAmount): self
    {
        $this->netAmount = $netAmount;
        return $this;
    }
}