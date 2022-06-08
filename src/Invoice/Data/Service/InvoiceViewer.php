<?php

declare(strict_types=1);

namespace App\Invoice\Data\Service;

use App\Invoice\Data\Model\InvoiceData;
use Twig\Environment as Template;

class InvoiceViewer
{
    public function __construct(
        private readonly Template $template
    ) {}

    public function render(InvoiceData $invoiceData, string $template = 'default'): string
    {
        return $this->template->render(self::preparePath($template), [
            'invoiceData' => $invoiceData
        ]);
    }

    private static function preparePath(string $template): string
    {
        return sprintf('invoice/%s/data.html.twig', $template);
    }
}