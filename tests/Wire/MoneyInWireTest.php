<?php

namespace Payabli\Tests;

use Payabli\Tests\Wire\WireMockTestCase;
use Payabli\PayabliClient;
use Payabli\MoneyIn\Requests\RequestPaymentAuthorize;
use Payabli\MoneyIn\Types\TransRequestBody;
use Payabli\Types\PayorDataRequest;
use Payabli\Types\PaymentDetail;
use Payabli\Types\PayMethodCredit;
use Payabli\MoneyIn\Types\CaptureRequest;
use Payabli\MoneyIn\Types\CapturePaymentDetails;
use Payabli\MoneyIn\Requests\RequestCredit;
use Payabli\Types\PaymentDetailCredit;
use Payabli\MoneyIn\Types\RequestCreditPaymentMethod;
use Payabli\Types\Achaccounttype;
use Payabli\MoneyIn\Requests\RequestPayment;
use Payabli\MoneyIn\Requests\RequestRefund;
use Payabli\Types\RefundDetail;
use Payabli\Types\SplitFundingRefundContent;
use Payabli\MoneyIn\Requests\SendReceipt2TransRequest;
use Payabli\MoneyIn\Requests\RequestPaymentValidate;
use Payabli\MoneyIn\Types\RequestPaymentValidatePaymentMethod;
use Payabli\MoneyIn\Types\RequestPaymentValidatePaymentMethodMethod;

class MoneyInWireTest extends WireMockTestCase
{
    /**
     * @var PayabliClient $client
     */
    private PayabliClient $client;

    /**
     */
    public function testAuthorize(): void {
        $testId = 'money_in.authorize.0';
        $this->client->moneyIn->authorize(
            new RequestPaymentAuthorize([
                'body' => new TransRequestBody([
                    'customerData' => new PayorDataRequest([
                        'customerId' => 4440,
                    ]),
                    'entryPoint' => 'f743aed24a',
                    'ipaddress' => '255.255.255.255',
                    'paymentDetails' => new PaymentDetail([
                        'serviceFee' => 0,
                        'totalAmount' => 100,
                    ]),
                    'paymentMethod' => new PayMethodCredit([
                        'cardcvv' => '999',
                        'cardexp' => '02/27',
                        'cardHolder' => 'John Cassian',
                        'cardnumber' => '4111111111111111',
                        'cardzip' => '12345',
                        'initiator' => 'payor',
                        'method' => 'card',
                    ]),
                ]),
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'money_in.authorize.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "POST",
            "/MoneyIn/authorize",
            null,
            1
        );
    }

    /**
     */
    public function testCapture(): void {
        $testId = 'money_in.capture.0';
        $this->client->moneyIn->capture(
            '10-7d9cd67d-2d5d-4cd7-a1b7-72b8b201ec13',
            0,
            [
                'headers' => [
                    'X-Test-Id' => 'money_in.capture.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/MoneyIn/capture/10-7d9cd67d-2d5d-4cd7-a1b7-72b8b201ec13/0",
            null,
            1
        );
    }

    /**
     */
    public function testCaptureAuth(): void {
        $testId = 'money_in.capture_auth.0';
        $this->client->moneyIn->captureAuth(
            '10-7d9cd67d-2d5d-4cd7-a1b7-72b8b201ec13',
            new CaptureRequest([
                'paymentDetails' => new CapturePaymentDetails([
                    'totalAmount' => 105,
                    'serviceFee' => 5,
                ]),
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'money_in.capture_auth.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "POST",
            "/MoneyIn/capture/10-7d9cd67d-2d5d-4cd7-a1b7-72b8b201ec13",
            null,
            1
        );
    }

    /**
     */
    public function testCredit(): void {
        $testId = 'money_in.credit.0';
        $this->client->moneyIn->credit(
            new RequestCredit([
                'idempotencyKey' => '6B29FC40-CA47-1067-B31D-00DD010662DA',
                'customerData' => new PayorDataRequest([
                    'billingAddress1' => '5127 Linkwood ave',
                    'customerNumber' => '100',
                ]),
                'entrypoint' => 'my-entrypoint',
                'paymentDetails' => new PaymentDetailCredit([
                    'serviceFee' => 0,
                    'totalAmount' => 1,
                ]),
                'paymentMethod' => new RequestCreditPaymentMethod([
                    'achAccount' => '88354454',
                    'achAccountType' => Achaccounttype::Checking->value,
                    'achHolder' => 'John Smith',
                    'achRouting' => '021000021',
                    'method' => 'ach',
                ]),
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'money_in.credit.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "POST",
            "/MoneyIn/makecredit",
            null,
            1
        );
    }

    /**
     */
    public function testDetails(): void {
        $testId = 'money_in.details.0';
        $this->client->moneyIn->details(
            '45-as456777hhhhhhhhhh77777777-324',
            [
                'headers' => [
                    'X-Test-Id' => 'money_in.details.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/MoneyIn/details/45-as456777hhhhhhhhhh77777777-324",
            null,
            1
        );
    }

    /**
     */
    public function testGetpaid(): void {
        $testId = 'money_in.getpaid.0';
        $this->client->moneyIn->getpaid(
            new RequestPayment([
                'body' => new TransRequestBody([
                    'customerData' => new PayorDataRequest([
                        'customerId' => 4440,
                    ]),
                    'entryPoint' => 'f743aed24a',
                    'ipaddress' => '255.255.255.255',
                    'paymentDetails' => new PaymentDetail([
                        'serviceFee' => 0,
                        'totalAmount' => 100,
                    ]),
                    'paymentMethod' => new PayMethodCredit([
                        'cardcvv' => '999',
                        'cardexp' => '02/27',
                        'cardHolder' => 'John Cassian',
                        'cardnumber' => '4111111111111111',
                        'cardzip' => '12345',
                        'initiator' => 'payor',
                        'method' => 'card',
                    ]),
                ]),
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'money_in.getpaid.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "POST",
            "/MoneyIn/getpaid",
            null,
            1
        );
    }

    /**
     */
    public function testReverse(): void {
        $testId = 'money_in.reverse.0';
        $this->client->moneyIn->reverse(
            0,
            '10-3ffa27df-b171-44e0-b251-e95fbfc7a723',
            [
                'headers' => [
                    'X-Test-Id' => 'money_in.reverse.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/MoneyIn/reverse/10-3ffa27df-b171-44e0-b251-e95fbfc7a723/0",
            null,
            1
        );
    }

    /**
     */
    public function testRefund(): void {
        $testId = 'money_in.refund.0';
        $this->client->moneyIn->refund(
            0,
            '10-3ffa27df-b171-44e0-b251-e95fbfc7a723',
            [
                'headers' => [
                    'X-Test-Id' => 'money_in.refund.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/MoneyIn/refund/10-3ffa27df-b171-44e0-b251-e95fbfc7a723/0",
            null,
            1
        );
    }

    /**
     */
    public function testRefundWithInstructions(): void {
        $testId = 'money_in.refund_with_instructions.0';
        $this->client->moneyIn->refundWithInstructions(
            '10-3ffa27df-b171-44e0-b251-e95fbfc7a723',
            new RequestRefund([
                'idempotencyKey' => '8A29FC40-CA47-1067-B31D-00DD010662DB',
                'source' => 'api',
                'orderDescription' => 'Materials deposit',
                'amount' => 100,
                'refundDetails' => new RefundDetail([
                    'splitRefunding' => [
                        new SplitFundingRefundContent([
                            'originationEntryPoint' => '7f1a381696',
                            'accountId' => '187-342',
                            'description' => 'Refunding undelivered materials',
                            'amount' => 60,
                        ]),
                        new SplitFundingRefundContent([
                            'originationEntryPoint' => '7f1a381696',
                            'accountId' => '187-343',
                            'description' => 'Refunding deposit for undelivered materials',
                            'amount' => 40,
                        ]),
                    ],
                ]),
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'money_in.refund_with_instructions.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "POST",
            "/MoneyIn/refund/10-3ffa27df-b171-44e0-b251-e95fbfc7a723",
            null,
            1
        );
    }

    /**
     */
    public function testReverseCredit(): void {
        $testId = 'money_in.reverse_credit.0';
        $this->client->moneyIn->reverseCredit(
            '45-as456777hhhhhhhhhh77777777-324',
            [
                'headers' => [
                    'X-Test-Id' => 'money_in.reverse_credit.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/MoneyIn/reverseCredit/45-as456777hhhhhhhhhh77777777-324",
            null,
            1
        );
    }

    /**
     */
    public function testSendReceipt2Trans(): void {
        $testId = 'money_in.send_receipt_2_trans.0';
        $this->client->moneyIn->sendReceipt2Trans(
            '45-as456777hhhhhhhhhh77777777-324',
            new SendReceipt2TransRequest([
                'email' => 'example@email.com',
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'money_in.send_receipt_2_trans.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/MoneyIn/sendreceipt/45-as456777hhhhhhhhhh77777777-324",
            ['email' => 'example@email.com'],
            1
        );
    }

    /**
     */
    public function testValidate(): void {
        $testId = 'money_in.validate.0';
        $this->client->moneyIn->validate(
            new RequestPaymentValidate([
                'idempotencyKey' => '6B29FC40-CA47-1067-B31D-00DD010662DA',
                'entryPoint' => 'entry132',
                'paymentMethod' => new RequestPaymentValidatePaymentMethod([
                    'method' => RequestPaymentValidatePaymentMethodMethod::Card->value,
                    'cardnumber' => '4360000001000005',
                    'cardexp' => '12/29',
                    'cardzip' => '14602-8328',
                    'cardHolder' => 'Dianne Becker-Smith',
                ]),
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'money_in.validate.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "POST",
            "/MoneyIn/validate",
            null,
            1
        );
    }

    /**
     */
    public function testVoid(): void {
        $testId = 'money_in.void.0';
        $this->client->moneyIn->void(
            '10-3ffa27df-b171-44e0-b251-e95fbfc7a723',
            [
                'headers' => [
                    'X-Test-Id' => 'money_in.void.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/MoneyIn/void/10-3ffa27df-b171-44e0-b251-e95fbfc7a723",
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
