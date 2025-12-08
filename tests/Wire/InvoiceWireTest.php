<?php

namespace Payabli\Tests;

use Payabli\Tests\Wire\WireMockTestCase;
use Payabli\PayabliClient;
use Payabli\Invoice\Requests\AddInvoiceRequest;
use Payabli\Invoice\Types\InvoiceDataRequest;
use Payabli\Types\PayorDataRequest;
use Payabli\Types\BillData;
use Payabli\Types\BillItem;
use DateTime;
use Payabli\Types\Frequency;
use Payabli\Invoice\Requests\EditInvoiceRequest;
use Payabli\Invoice\Requests\GetAttachedFileFromInvoiceRequest;
use Payabli\Invoice\Requests\ListInvoicesRequest;
use Payabli\Invoice\Requests\ListInvoicesOrgRequest;
use Payabli\Invoice\Requests\SendInvoiceRequest;

class InvoiceWireTest extends WireMockTestCase
{
    /**
     * @var PayabliClient $client
     */
    private PayabliClient $client;

    /**
     */
    public function testAddInvoice(): void {
        $testId = 'invoice.add_invoice.0';
        $this->client->invoice->addInvoice(
            '8cfec329267',
            new AddInvoiceRequest([
                'body' => new InvoiceDataRequest([
                    'customerData' => new PayorDataRequest([
                        'firstName' => 'Tamara',
                        'lastName' => 'Bagratoni',
                        'customerNumber' => '3',
                    ]),
                    'invoiceData' => new BillData([
                        'items' => [
                            new BillItem([
                                'itemProductName' => 'Adventure Consult',
                                'itemDescription' => 'Consultation for Georgian tours',
                                'itemCost' => 100,
                                'itemQty' => 1,
                                'itemMode' => 1,
                            ]),
                            new BillItem([
                                'itemProductName' => 'Deposit ',
                                'itemDescription' => 'Deposit for trip planning',
                                'itemCost' => 882.37,
                                'itemQty' => 1,
                            ]),
                        ],
                        'invoiceDate' => new DateTime('2025-10-19'),
                        'invoiceType' => 0,
                        'invoiceStatus' => 1,
                        'frequency' => Frequency::OneTime->value,
                        'invoiceAmount' => 982.37,
                        'discount' => 10,
                        'invoiceNumber' => 'INV-3',
                    ]),
                ]),
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'invoice.add_invoice.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "POST",
            "/Invoice/8cfec329267",
            null,
            1
        );
    }

    /**
     */
    public function testDeleteAttachedFromInvoice(): void {
        $testId = 'invoice.delete_attached_from_invoice.0';
        $this->client->invoice->deleteAttachedFromInvoice(
            '0_Bill.pdf',
            23548884,
            [
                'headers' => [
                    'X-Test-Id' => 'invoice.delete_attached_from_invoice.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "DELETE",
            "/Invoice/attachedFileFromInvoice/23548884/0_Bill.pdf",
            null,
            1
        );
    }

    /**
     */
    public function testDeleteInvoice(): void {
        $testId = 'invoice.delete_invoice.0';
        $this->client->invoice->deleteInvoice(
            23548884,
            [
                'headers' => [
                    'X-Test-Id' => 'invoice.delete_invoice.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "DELETE",
            "/Invoice/23548884",
            null,
            1
        );
    }

    /**
     */
    public function testEditInvoice(): void {
        $testId = 'invoice.edit_invoice.0';
        $this->client->invoice->editInvoice(
            332,
            new EditInvoiceRequest([
                'body' => new InvoiceDataRequest([
                    'invoiceData' => new BillData([
                        'items' => [
                            new BillItem([
                                'itemProductName' => 'Deposit',
                                'itemDescription' => 'Deposit for trip planning',
                                'itemCost' => 882.37,
                                'itemQty' => 1,
                            ]),
                        ],
                        'invoiceDate' => new DateTime('2025-10-19'),
                        'invoiceAmount' => 982.37,
                        'invoiceNumber' => 'INV-6',
                    ]),
                ]),
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'invoice.edit_invoice.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "PUT",
            "/Invoice/332",
            null,
            1
        );
    }

    /**
     */
    public function testGetAttachedFileFromInvoice(): void {
        $testId = 'invoice.get_attached_file_from_invoice.0';
        $this->client->invoice->getAttachedFileFromInvoice(
            1,
            'filename',
            new GetAttachedFileFromInvoiceRequest([]),
            [
                'headers' => [
                    'X-Test-Id' => 'invoice.get_attached_file_from_invoice.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Invoice/attachedFileFromInvoice/1/filename",
            null,
            1
        );
    }

    /**
     */
    public function testGetInvoice(): void {
        $testId = 'invoice.get_invoice.0';
        $this->client->invoice->getInvoice(
            23548884,
            [
                'headers' => [
                    'X-Test-Id' => 'invoice.get_invoice.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Invoice/23548884",
            null,
            1
        );
    }

    /**
     */
    public function testGetInvoiceNumber(): void {
        $testId = 'invoice.get_invoice_number.0';
        $this->client->invoice->getInvoiceNumber(
            '8cfec329267',
            [
                'headers' => [
                    'X-Test-Id' => 'invoice.get_invoice_number.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Invoice/getNumber/8cfec329267",
            null,
            1
        );
    }

    /**
     */
    public function testListInvoices(): void {
        $testId = 'invoice.list_invoices.0';
        $this->client->invoice->listInvoices(
            '8cfec329267',
            new ListInvoicesRequest([
                'fromRecord' => 251,
                'limitRecord' => 0,
                'sortBy' => 'desc(field_name)',
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'invoice.list_invoices.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Query/invoices/8cfec329267",
            ['fromRecord' => '251', 'limitRecord' => '0', 'sortBy' => 'desc(field_name)'],
            1
        );
    }

    /**
     */
    public function testListInvoicesOrg(): void {
        $testId = 'invoice.list_invoices_org.0';
        $this->client->invoice->listInvoicesOrg(
            123,
            new ListInvoicesOrgRequest([
                'fromRecord' => 251,
                'limitRecord' => 0,
                'sortBy' => 'desc(field_name)',
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'invoice.list_invoices_org.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Query/invoices/org/123",
            ['fromRecord' => '251', 'limitRecord' => '0', 'sortBy' => 'desc(field_name)'],
            1
        );
    }

    /**
     */
    public function testSendInvoice(): void {
        $testId = 'invoice.send_invoice.0';
        $this->client->invoice->sendInvoice(
            23548884,
            new SendInvoiceRequest([
                'attachfile' => true,
                'mail2' => 'tamara@example.com',
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'invoice.send_invoice.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Invoice/send/23548884",
            ['attachfile' => 'true', 'mail2' => 'tamara@example.com'],
            1
        );
    }

    /**
     */
    public function testGetInvoicePdf(): void {
        $testId = 'invoice.get_invoice_pdf.0';
        $this->client->invoice->getInvoicePdf(
            23548884,
            [
                'headers' => [
                    'X-Test-Id' => 'invoice.get_invoice_pdf.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Export/invoicePdf/23548884",
            null,
            1
        );
    }

    /**
     */
    protected function setUp(): void {
        parent::setUp();
        $this->client = new PayabliClient(
            apiKey: 'test-apiKey',
        options: [
            'baseUrl' => 'http://localhost:8080',
        ],
        );
    }
}
