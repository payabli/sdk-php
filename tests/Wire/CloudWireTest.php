<?php

namespace Payabli\Tests;

use Payabli\Tests\Wire\WireMockTestCase;
use Payabli\PayabliClient;
use Payabli\Cloud\Requests\DeviceEntry;
use Payabli\Cloud\Requests\ListDeviceRequest;

class CloudWireTest extends WireMockTestCase
{
    /**
     * @var PayabliClient $client
     */
    private PayabliClient $client;

    /**
     */
    public function testAddDevice(): void {
        $testId = 'cloud.add_device.0';
        $this->client->cloud->addDevice(
            '8cfec329267',
            new DeviceEntry([
                'registrationCode' => 'YS7DS5',
                'description' => 'Front Desk POS',
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'cloud.add_device.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "POST",
            "/Cloud/register/8cfec329267",
            null,
            1
        );
    }

    /**
     */
    public function testHistoryDevice(): void {
        $testId = 'cloud.history_device.0';
        $this->client->cloud->historyDevice(
            'WXGDWB',
            '8cfec329267',
            [
                'headers' => [
                    'X-Test-Id' => 'cloud.history_device.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Cloud/history/8cfec329267/WXGDWB",
            null,
            1
        );
    }

    /**
     */
    public function testListDevice(): void {
        $testId = 'cloud.list_device.0';
        $this->client->cloud->listDevice(
            '8cfec329267',
            new ListDeviceRequest([]),
            [
                'headers' => [
                    'X-Test-Id' => 'cloud.list_device.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Cloud/list/8cfec329267",
            null,
            1
        );
    }

    /**
     */
    public function testRemoveDevice(): void {
        $testId = 'cloud.remove_device.0';
        $this->client->cloud->removeDevice(
            '6c361c7d-674c-44cc-b790-382b75d1xxx',
            '8cfec329267',
            [
                'headers' => [
                    'X-Test-Id' => 'cloud.remove_device.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "DELETE",
            "/Cloud/register/8cfec329267/6c361c7d-674c-44cc-b790-382b75d1xxx",
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
