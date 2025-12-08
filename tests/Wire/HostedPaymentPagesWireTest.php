<?php

namespace Payabli\Tests;

use Payabli\Tests\Wire\WireMockTestCase;
use Payabli\PayabliClient;
use Payabli\HostedPaymentPages\Requests\NewPageRequest;
use Payabli\Types\PayabliPages;

class HostedPaymentPagesWireTest extends WireMockTestCase
{
    /**
     * @var PayabliClient $client
     */
    private PayabliClient $client;

    /**
     */
    public function testLoadPage(): void {
        $testId = 'hosted_payment_pages.load_page.0';
        $this->client->hostedPaymentPages->loadPage(
            '8cfec329267',
            'pay-your-fees-1',
            [
                'headers' => [
                    'X-Test-Id' => 'hosted_payment_pages.load_page.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Paypoint/load/8cfec329267/pay-your-fees-1",
            null,
            1
        );
    }

    /**
     */
    public function testNewPage(): void {
        $testId = 'hosted_payment_pages.new_page.0';
        $this->client->hostedPaymentPages->newPage(
            '8cfec329267',
            new NewPageRequest([
                'idempotencyKey' => '6B29FC40-CA47-1067-B31D-00DD010662DA',
                'body' => new PayabliPages([]),
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'hosted_payment_pages.new_page.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "POST",
            "/Paypoint/8cfec329267",
            null,
            1
        );
    }

    /**
     */
    public function testSavePage(): void {
        $testId = 'hosted_payment_pages.save_page.0';
        $this->client->hostedPaymentPages->savePage(
            '8cfec329267',
            'pay-your-fees-1',
            new PayabliPages([]),
            [
                'headers' => [
                    'X-Test-Id' => 'hosted_payment_pages.save_page.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "PUT",
            "/Paypoint/8cfec329267/pay-your-fees-1",
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
