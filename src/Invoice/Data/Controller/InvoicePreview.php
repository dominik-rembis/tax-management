<?php

namespace App\Invoice\Data\Controller;

use App\Invoice\Data\Model\InvoiceData;
use App\Invoice\Data\Service\InvoiceViewer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class InvoicePreview extends AbstractController
{
    public function __construct(
        private readonly InvoiceViewer $invoiceViewer
    ) {}

    public function __invoke(InvoiceData $invoiceData): Response
    {
        return new Response(
            $this->invoiceViewer->render($invoiceData)
        );
    }
}
