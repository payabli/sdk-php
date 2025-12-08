<?php

namespace Payabli\Tests;

use Payabli\Tests\Wire\WireMockTestCase;
use Payabli\PayabliClient;
use Payabli\MoneyOut\Requests\MoneyOutTypesRequestOutAuthorize;
use Payabli\MoneyOutTypes\Types\AuthorizePayoutBody;
use Payabli\MoneyOutTypes\Types\RequestOutAuthorizeInvoiceData;
use Payabli\MoneyOutTypes\Types\RequestOutAuthorizePaymentDetails;
use Payabli\MoneyOutTypes\Types\AuthorizePaymentMethod;
use Payabli\MoneyOutTypes\Types\RequestOutAuthorizeVendorData;
use Payabli\MoneyOut\Requests\CaptureAllOutRequest;
use Payabli\MoneyOut\Requests\CaptureOutRequest;
use Payabli\MoneyOut\Requests\SendVCardLinkRequest;

class MoneyOutWireTest extends WireMockTestCase
{
    /**
     * @var PayabliClient $client
     */
    private PayabliClient $client;

    /**
     */
    public function testAuthorizeOut(): void {
        $testId = 'money_out.authorize_out.0';
        $this->client->moneyOut->authorizeOut(
            new MoneyOutTypesRequestOutAuthorize([
                'body' => new AuthorizePayoutBody([
                    'entryPoint' => '48acde49',
                    'invoiceData' => [
                        new RequestOutAuthorizeInvoiceData([
                            'billId' => 54323,
                        ]),
                    ],
                    'orderDescription' => 'Window Painting',
                    'paymentDetails' => new RequestOutAuthorizePaymentDetails([
                        'totalAmount' => 47,
                        'unbundled' => false,
                    ]),
                    'paymentMethod' => new AuthorizePaymentMethod([
                        'method' => 'managed',
                    ]),
                    'vendorData' => new RequestOutAuthorizeVendorData([
                        'vendorNumber' => '7895433',
                    ]),
                ]),
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'money_out.authorize_out.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "POST",
            "/MoneyOut/authorize",
            null,
            1
        );
    }

    /**
     */
    public function testCancelAllOut(): void {
        $testId = 'money_out.cancel_all_out.0';
        $this->client->moneyOut->cancelAllOut(
            [
                '2-29',
                '2-28',
                '2-27',
            ],
            [
                'headers' => [
                    'X-Test-Id' => 'money_out.cancel_all_out.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "POST",
            "/MoneyOut/cancelAll",
            null,
            1
        );
    }

    /**
     */
    public function testCancelOutGet(): void {
        $testId = 'money_out.cancel_out_get.0';
        $this->client->moneyOut->cancelOutGet(
            '129-219',
            [
                'headers' => [
                    'X-Test-Id' => 'money_out.cancel_out_get.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/MoneyOut/cancel/129-219",
            null,
            1
        );
    }

    /**
     */
    public function testCancelOutDelete(): void {
        $testId = 'money_out.cancel_out_delete.0';
        $this->client->moneyOut->cancelOutDelete(
            '129-219',
            [
                'headers' => [
                    'X-Test-Id' => 'money_out.cancel_out_delete.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "DELETE",
            "/MoneyOut/cancel/129-219",
            null,
            1
        );
    }

    /**
     */
    public function testCaptureAllOut(): void {
        $testId = 'money_out.capture_all_out.0';
        $this->client->moneyOut->captureAllOut(
            new CaptureAllOutRequest([
                'body' => [
                    '2-29',
                    '2-28',
                    '2-27',
                ],
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'money_out.capture_all_out.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "POST",
            "/MoneyOut/captureAll",
            null,
            1
        );
    }

    /**
     */
    public function testCaptureOut(): void {
        $testId = 'money_out.capture_out.0';
        $this->client->moneyOut->captureOut(
            '129-219',
            new CaptureOutRequest([]),
            [
                'headers' => [
                    'X-Test-Id' => 'money_out.capture_out.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/MoneyOut/capture/129-219",
            null,
            1
        );
    }

    /**
     */
    public function testPayoutDetails(): void {
        $testId = 'money_out.payout_details.0';
        $this->client->moneyOut->payoutDetails(
            '45-as456777hhhhhhhhhh77777777-324',
            [
                'headers' => [
                    'X-Test-Id' => 'money_out.payout_details.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/MoneyOut/details/45-as456777hhhhhhhhhh77777777-324",
            null,
            1
        );
    }

    /**
     */
    public function testVCardGet(): void {
        $testId = 'money_out.v_card_get.0';
        $this->client->moneyOut->vCardGet(
            '20230403315245421165',
            [
                'headers' => [
                    'X-Test-Id' => 'money_out.v_card_get.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/MoneyOut/vcard/20230403315245421165",
            null,
            1
        );
    }

    /**
     */
    public function testSendVCardLink(): void {
        $testId = 'money_out.send_v_card_link.0';
        $this->client->moneyOut->sendVCardLink(
            new SendVCardLinkRequest([
                'transId' => '01K33Z6YQZ6GD5QVKZ856MJBSC',
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'money_out.send_v_card_link.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "POST",
            "/vcard/send-card-link",
            null,
            1
        );
    }

    /**
     */
    public function testGetCheckImage(): void {
        $testId = 'money_out.get_check_image.0';
        $this->client->moneyOut->getCheckImage(
            'check133832686289732320_01JKBNZ5P32JPTZY8XXXX000000.pdf',
            [
                'headers' => [
                    'X-Test-Id' => 'money_out.get_check_image.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/MoneyOut/checkimage/check133832686289732320_01JKBNZ5P32JPTZY8XXXX000000.pdf",
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
