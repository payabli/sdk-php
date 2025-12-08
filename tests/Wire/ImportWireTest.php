<?php

namespace Payabli\Tests;

use Payabli\Tests\Wire\WireMockTestCase;
use Payabli\PayabliClient;
use Payabli\Import\Requests\ImportBillsRequest;
use Payabli\Import\Requests\ImportCustomerRequest;
use Payabli\Import\Requests\ImportVendorRequest;

class ImportWireTest extends WireMockTestCase
{
    /**
     * @var PayabliClient $client
     */
    private PayabliClient $client;

    /**
     */
    public function testImportBills(): void {
        $testId = 'import.import_bills.0';
        $this->client->import->importBills(
            '8cfec329267',
            new ImportBillsRequest([]),
            [
                'headers' => [
                    'X-Test-Id' => 'import.import_bills.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "POST",
            "/Import/billsForm/8cfec329267",
            null,
            1
        );
    }

    /**
     */
    public function testImportCustomer(): void {
        $testId = 'import.import_customer.0';
        $this->client->import->importCustomer(
            '8cfec329267',
            new ImportCustomerRequest([]),
            [
                'headers' => [
                    'X-Test-Id' => 'import.import_customer.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "POST",
            "/Import/customersForm/8cfec329267",
            null,
            1
        );
    }

    /**
     */
    public function testImportVendor(): void {
        $testId = 'import.import_vendor.0';
        $this->client->import->importVendor(
            '8cfec329267',
            new ImportVendorRequest([]),
            [
                'headers' => [
                    'X-Test-Id' => 'import.import_vendor.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "POST",
            "/Import/vendorsForm/8cfec329267",
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
