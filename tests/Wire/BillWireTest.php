<?php

namespace Payabli\Tests;

use Payabli\Tests\Wire\WireMockTestCase;
use Payabli\PayabliClient;
use Payabli\Bill\Requests\AddBillRequest;
use Payabli\Bill\Types\BillOutData;
use DateTime;
use Payabli\Types\BillItem;
use Payabli\Types\VendorData;
use Payabli\Types\Frequency;
use Payabli\Types\FileContent;
use Payabli\Types\FileContentFtype;
use Payabli\Bill\Requests\DeleteAttachedFromBillRequest;
use Payabli\Bill\Requests\GetAttachedFromBillRequest;
use Payabli\Bill\Requests\ListBillsRequest;
use Payabli\Bill\Requests\ListBillsOrgRequest;
use Payabli\Bill\Requests\SendToApprovalBillRequest;
use Payabli\Bill\Requests\SetApprovedBillRequest;

class BillWireTest extends WireMockTestCase
{
    /**
     * @var PayabliClient $client
     */
    private PayabliClient $client;

    /**
     */
    public function testAddBill(): void {
        $testId = 'bill.add_bill.0';
        $this->client->bill->addBill(
            '8cfec329267',
            new AddBillRequest([
                'body' => new BillOutData([
                    'billNumber' => 'ABC-123',
                    'netAmount' => 3762.87,
                    'billDate' => new DateTime('2024-07-01'),
                    'dueDate' => new DateTime('2024-07-01'),
                    'comments' => 'Deposit for materials',
                    'billItems' => [
                        new BillItem([
                            'itemProductCode' => 'M-DEPOSIT',
                            'itemProductName' => 'Materials deposit',
                            'itemDescription' => 'Deposit for materials',
                            'itemCommodityCode' => '010',
                            'itemUnitOfMeasure' => 'SqFt',
                            'itemCost' => 5,
                            'itemQty' => 1,
                            'itemMode' => 0,
                            'itemCategories' => [
                                'deposits',
                            ],
                            'itemTotalAmount' => 123,
                            'itemTaxAmount' => 7,
                            'itemTaxRate' => 0.075,
                        ]),
                    ],
                    'mode' => 0,
                    'accountingField1' => 'MyInternalId',
                    'vendor' => new VendorData([
                        'vendorNumber' => '1234-A',
                    ]),
                    'endDate' => new DateTime('2024-07-01'),
                    'frequency' => Frequency::Monthly->value,
                    'terms' => 'NET30',
                    'status' => -99,
                    'attachments' => [
                        new FileContent([
                            'ftype' => FileContentFtype::Pdf->value,
                            'filename' => 'my-doc.pdf',
                            'furl' => 'https://mysite.com/my-doc.pdf',
                        ]),
                    ],
                ]),
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'bill.add_bill.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "POST",
            "/Bill/single/8cfec329267",
            null,
            1
        );
    }

    /**
     */
    public function testDeleteAttachedFromBill(): void {
        $testId = 'bill.delete_attached_from_bill.0';
        $this->client->bill->deleteAttachedFromBill(
            '0_Bill.pdf',
            285,
            new DeleteAttachedFromBillRequest([]),
            [
                'headers' => [
                    'X-Test-Id' => 'bill.delete_attached_from_bill.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "DELETE",
            "/Bill/attachedFileFromBill/285/0_Bill.pdf",
            null,
            1
        );
    }

    /**
     */
    public function testDeleteBill(): void {
        $testId = 'bill.delete_bill.0';
        $this->client->bill->deleteBill(
            285,
            [
                'headers' => [
                    'X-Test-Id' => 'bill.delete_bill.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "DELETE",
            "/Bill/285",
            null,
            1
        );
    }

    /**
     */
    public function testEditBill(): void {
        $testId = 'bill.edit_bill.0';
        $this->client->bill->editBill(
            285,
            new BillOutData([
                'netAmount' => 3762.87,
                'billDate' => new DateTime('2025-07-01'),
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'bill.edit_bill.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "PUT",
            "/Bill/285",
            null,
            1
        );
    }

    /**
     */
    public function testGetAttachedFromBill(): void {
        $testId = 'bill.get_attached_from_bill.0';
        $this->client->bill->getAttachedFromBill(
            '0_Bill.pdf',
            285,
            new GetAttachedFromBillRequest([
                'returnObject' => true,
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'bill.get_attached_from_bill.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Bill/attachedFileFromBill/285/0_Bill.pdf",
            ['returnObject' => 'true'],
            1
        );
    }

    /**
     */
    public function testGetBill(): void {
        $testId = 'bill.get_bill.0';
        $this->client->bill->getBill(
            285,
            [
                'headers' => [
                    'X-Test-Id' => 'bill.get_bill.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Bill/285",
            null,
            1
        );
    }

    /**
     */
    public function testListBills(): void {
        $testId = 'bill.list_bills.0';
        $this->client->bill->listBills(
            '8cfec329267',
            new ListBillsRequest([
                'fromRecord' => 251,
                'limitRecord' => 0,
                'sortBy' => 'desc(field_name)',
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'bill.list_bills.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Query/bills/8cfec329267",
            ['fromRecord' => '251', 'limitRecord' => '0', 'sortBy' => 'desc(field_name)'],
            1
        );
    }

    /**
     */
    public function testListBillsOrg(): void {
        $testId = 'bill.list_bills_org.0';
        $this->client->bill->listBillsOrg(
            123,
            new ListBillsOrgRequest([
                'fromRecord' => 251,
                'limitRecord' => 0,
                'sortBy' => 'desc(field_name)',
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'bill.list_bills_org.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Query/bills/org/123",
            ['fromRecord' => '251', 'limitRecord' => '0', 'sortBy' => 'desc(field_name)'],
            1
        );
    }

    /**
     */
    public function testModifyApprovalBill(): void {
        $testId = 'bill.modify_approval_bill.0';
        $this->client->bill->modifyApprovalBill(
            285,
            [
                'string',
            ],
            [
                'headers' => [
                    'X-Test-Id' => 'bill.modify_approval_bill.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "PUT",
            "/Bill/approval/285",
            null,
            1
        );
    }

    /**
     */
    public function testSendToApprovalBill(): void {
        $testId = 'bill.send_to_approval_bill.0';
        $this->client->bill->sendToApprovalBill(
            285,
            new SendToApprovalBillRequest([
                'idempotencyKey' => '6B29FC40-CA47-1067-B31D-00DD010662DA',
                'body' => [
                    'string',
                ],
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'bill.send_to_approval_bill.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "POST",
            "/Bill/approval/285",
            null,
            1
        );
    }

    /**
     */
    public function testSetApprovedBill(): void {
        $testId = 'bill.set_approved_bill.0';
        $this->client->bill->setApprovedBill(
            'true',
            285,
            new SetApprovedBillRequest([]),
            [
                'headers' => [
                    'X-Test-Id' => 'bill.set_approved_bill.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Bill/approval/285/true",
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
