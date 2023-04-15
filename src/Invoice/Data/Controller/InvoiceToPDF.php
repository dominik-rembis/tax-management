<?php

declare(strict_types=1);

namespace App\Invoice\Data\Controller;

use App\Invoice\Data\Model\InvoiceData;
use App\Invoice\Data\Service\InvoiceViewer;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Knp\Snappy\Pdf as PdfGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class InvoiceToPDF extends AbstractController
{
    private const FILE_NAME = 'invoice.pdf';

    public function __construct(
        private readonly InvoiceViewer $invoiceViewer,
        private readonly PdfGenerator $pdfGenerator
    ) {}

    public function __invoke(InvoiceData $invoiceData): PdfResponse
    {
        return new PdfResponse(
            $this->pdfGenerator->getOutputFromHtml(
                $this->invoiceViewer->render($invoiceData)
            ),
            self::FILE_NAME
        );
    }
}