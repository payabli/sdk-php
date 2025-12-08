<?php

namespace Payabli\Tests;

use Payabli\Tests\Wire\WireMockTestCase;
use Payabli\PayabliClient;
use Payabli\PaymentMethodDomain\Requests\AddPaymentMethodDomainRequest;
use Payabli\PaymentMethodDomain\Types\AddPaymentMethodDomainRequestApplePay;
use Payabli\PaymentMethodDomain\Types\AddPaymentMethodDomainRequestGooglePay;
use Payabli\PaymentMethodDomain\Requests\ListPaymentMethodDomainsRequest;
use Payabli\PaymentMethodDomain\Requests\UpdatePaymentMethodDomainRequest;
use Payabli\PaymentMethodDomain\Types\UpdatePaymentMethodDomainRequestWallet;

class PaymentMethodDomainWireTest extends WireMockTestCase
{
    /**
     * @var PayabliClient $client
     */
    private PayabliClient $client;

    /**
     */
    public function testAddPaymentMethodDomain(): void {
        $testId = 'payment_method_domain.add_payment_method_domain.0';
        $this->client->paymentMethodDomain->addPaymentMethodDomain(
            new AddPaymentMethodDomainRequest([
                'domainName' => 'checkout.example.com',
                'entityId' => 109,
                'entityType' => 'paypoint',
                'applePay' => new AddPaymentMethodDomainRequestApplePay([
                    'isEnabled' => true,
                ]),
                'googlePay' => new AddPaymentMethodDomainRequestGooglePay([
                    'isEnabled' => true,
                ]),
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'payment_method_domain.add_payment_method_domain.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "POST",
            "/PaymentMethodDomain",
            null,
            1
        );
    }

    /**
     */
    public function testCascadePaymentMethodDomain(): void {
        $testId = 'payment_method_domain.cascade_payment_method_domain.0';
        $this->client->paymentMethodDomain->cascadePaymentMethodDomain(
            'pmd_b8237fa45c964d8a9ef27160cd42b8c5',
            [
                'headers' => [
                    'X-Test-Id' => 'payment_method_domain.cascade_payment_method_domain.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "POST",
            "/PaymentMethodDomain/pmd_b8237fa45c964d8a9ef27160cd42b8c5/cascade",
            null,
            1
        );
    }

    /**
     */
    public function testDeletePaymentMethodDomain(): void {
        $testId = 'payment_method_domain.delete_payment_method_domain.0';
        $this->client->paymentMethodDomain->deletePaymentMethodDomain(
            'pmd_b8237fa45c964d8a9ef27160cd42b8c5',
            [
                'headers' => [
                    'X-Test-Id' => 'payment_method_domain.delete_payment_method_domain.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "DELETE",
            "/PaymentMethodDomain/pmd_b8237fa45c964d8a9ef27160cd42b8c5",
            null,
            1
        );
    }

    /**
     */
    public function testGetPaymentMethodDomain(): void {
        $testId = 'payment_method_domain.get_payment_method_domain.0';
        $this->client->paymentMethodDomain->getPaymentMethodDomain(
            'pmd_b8237fa45c964d8a9ef27160cd42b8c5',
            [
                'headers' => [
                    'X-Test-Id' => 'payment_method_domain.get_payment_method_domain.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/PaymentMethodDomain/pmd_b8237fa45c964d8a9ef27160cd42b8c5",
            null,
            1
        );
    }

    /**
     */
    public function testListPaymentMethodDomains(): void {
        $testId = 'payment_method_domain.list_payment_method_domains.0';
        $this->client->paymentMethodDomain->listPaymentMethodDomains(
            new ListPaymentMethodDomainsRequest([
                'entityId' => 1147,
                'entityType' => 'paypoint',
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'payment_method_domain.list_payment_method_domains.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/PaymentMethodDomain/list",
            ['entityId' => '1147', 'entityType' => 'paypoint'],
            1
        );
    }

    /**
     */
    public function testUpdatePaymentMethodDomain(): void {
        $testId = 'payment_method_domain.update_payment_method_domain.0';
        $this->client->paymentMethodDomain->updatePaymentMethodDomain(
            'pmd_b8237fa45c964d8a9ef27160cd42b8c5',
            new UpdatePaymentMethodDomainRequest([
                'applePay' => new UpdatePaymentMethodDomainRequestWallet([
                    'isEnabled' => false,
                ]),
                'googlePay' => new UpdatePaymentMethodDomainRequestWallet([
                    'isEnabled' => false,
                ]),
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'payment_method_domain.update_payment_method_domain.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "PATCH",
            "/PaymentMethodDomain/pmd_b8237fa45c964d8a9ef27160cd42b8c5",
            null,
            1
        );
    }

    /**
     */
    public function testVerifyPaymentMethodDomain(): void {
        $testId = 'payment_method_domain.verify_payment_method_domain.0';
        $this->client->paymentMethodDomain->verifyPaymentMethodDomain(
            'pmd_b8237fa45c964d8a9ef27160cd42b8c5',
            [
                'headers' => [
                    'X-Test-Id' => 'payment_method_domain.verify_payment_method_domain.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "POST",
            "/PaymentMethodDomain/pmd_b8237fa45c964d8a9ef27160cd42b8c5/verify",
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
