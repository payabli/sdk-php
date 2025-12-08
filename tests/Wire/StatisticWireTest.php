<?php

namespace Payabli\Tests;

use Payabli\Tests\Wire\WireMockTestCase;
use Payabli\PayabliClient;
use Payabli\Statistic\Requests\BasicStatsRequest;
use Payabli\Statistic\Requests\CustomerBasicStatsRequest;
use Payabli\Statistic\Requests\SubStatsRequest;
use Payabli\Statistic\Requests\VendorBasicStatsRequest;

class StatisticWireTest extends WireMockTestCase
{
    /**
     * @var PayabliClient $client
     */
    private PayabliClient $client;

    /**
     */
    public function testBasicStats(): void {
        $testId = 'statistic.basic_stats.0';
        $this->client->statistic->basicStats(
            1000000,
            'm',
            1,
            'ytd',
            new BasicStatsRequest([
                'endDate' => '2025-11-01',
                'startDate' => '2025-11-30',
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'statistic.basic_stats.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Statistic/basic/ytd/m/1/1000000",
            ['endDate' => '2025-11-01', 'startDate' => '2025-11-30'],
            1
        );
    }

    /**
     */
    public function testCustomerBasicStats(): void {
        $testId = 'statistic.customer_basic_stats.0';
        $this->client->statistic->customerBasicStats(
            998,
            'm',
            'ytd',
            new CustomerBasicStatsRequest([]),
            [
                'headers' => [
                    'X-Test-Id' => 'statistic.customer_basic_stats.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Statistic/customerbasic/ytd/m/998",
            null,
            1
        );
    }

    /**
     */
    public function testSubStats(): void {
        $testId = 'statistic.sub_stats.0';
        $this->client->statistic->subStats(
            1000000,
            '30',
            1,
            new SubStatsRequest([]),
            [
                'headers' => [
                    'X-Test-Id' => 'statistic.sub_stats.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Statistic/subscriptions/30/1/1000000",
            null,
            1
        );
    }

    /**
     */
    public function testVendorBasicStats(): void {
        $testId = 'statistic.vendor_basic_stats.0';
        $this->client->statistic->vendorBasicStats(
            'm',
            1,
            'ytd',
            new VendorBasicStatsRequest([]),
            [
                'headers' => [
                    'X-Test-Id' => 'statistic.vendor_basic_stats.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Statistic/vendorbasic/ytd/m/1",
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
