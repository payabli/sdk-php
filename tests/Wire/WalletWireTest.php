<?php

namespace Payabli\Tests;

use Payabli\Tests\Wire\WireMockTestCase;
use Payabli\PayabliClient;
use Payabli\Wallet\Requests\ConfigureOrganizationRequestApplePay;
use Payabli\Wallet\Requests\ConfigurePaypointRequestApplePay;
use Payabli\Wallet\Requests\ConfigureOrganizationRequestGooglePay;
use Payabli\Wallet\Requests\ConfigurePaypointRequestGooglePay;

class WalletWireTest extends WireMockTestCase
{
    /**
     * @var PayabliClient $client
     */
    private PayabliClient $client;

    /**
     */
    public function testConfigureApplePayOrganization(): void {
        $testId = 'wallet.configure_apple_pay_organization.0';
        $this->client->wallet->configureApplePayOrganization(
            new ConfigureOrganizationRequestApplePay([
                'cascade' => true,
                'isEnabled' => true,
                'orgId' => 901,
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'wallet.configure_apple_pay_organization.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "POST",
            "/Wallet/applepay/configure-organization",
            null,
            1
        );
    }

    /**
     */
    public function testConfigureApplePayPaypoint(): void {
        $testId = 'wallet.configure_apple_pay_paypoint.0';
        $this->client->wallet->configureApplePayPaypoint(
            new ConfigurePaypointRequestApplePay([
                'entry' => '8cfec329267',
                'isEnabled' => true,
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'wallet.configure_apple_pay_paypoint.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "POST",
            "/Wallet/applepay/configure-paypoint",
            null,
            1
        );
    }

    /**
     */
    public function testConfigureGooglePayOrganization(): void {
        $testId = 'wallet.configure_google_pay_organization.0';
        $this->client->wallet->configureGooglePayOrganization(
            new ConfigureOrganizationRequestGooglePay([
                'cascade' => true,
                'isEnabled' => true,
                'orgId' => 901,
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'wallet.configure_google_pay_organization.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "POST",
            "/Wallet/googlepay/configure-organization",
            null,
            1
        );
    }

    /**
     */
    public function testConfigureGooglePayPaypoint(): void {
        $testId = 'wallet.configure_google_pay_paypoint.0';
        $this->client->wallet->configureGooglePayPaypoint(
            new ConfigurePaypointRequestGooglePay([
                'entry' => '8cfec329267',
                'isEnabled' => true,
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'wallet.configure_google_pay_paypoint.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "POST",
            "/Wallet/googlepay/configure-paypoint",
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
