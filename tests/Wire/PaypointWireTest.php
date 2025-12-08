<?php

namespace Payabli\Tests;

use Payabli\Tests\Wire\WireMockTestCase;
use Payabli\PayabliClient;
use Payabli\Paypoint\Requests\GetEntryConfigRequest;
use Payabli\Types\FileContent;
use Payabli\Paypoint\Types\PaypointMoveRequest;
use Payabli\Paypoint\Types\NotificationRequest;
use Payabli\Paypoint\Types\WebHeaderParameter;

class PaypointWireTest extends WireMockTestCase
{
    /**
     * @var PayabliClient $client
     */
    private PayabliClient $client;

    /**
     */
    public function testGetBasicEntry(): void {
        $testId = 'paypoint.get_basic_entry.0';
        $this->client->paypoint->getBasicEntry(
            '8cfec329267',
            [
                'headers' => [
                    'X-Test-Id' => 'paypoint.get_basic_entry.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Paypoint/basic/8cfec329267",
            null,
            1
        );
    }

    /**
     */
    public function testGetBasicEntryById(): void {
        $testId = 'paypoint.get_basic_entry_by_id.0';
        $this->client->paypoint->getBasicEntryById(
            '198',
            [
                'headers' => [
                    'X-Test-Id' => 'paypoint.get_basic_entry_by_id.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Paypoint/basicById/198",
            null,
            1
        );
    }

    /**
     */
    public function testGetEntryConfig(): void {
        $testId = 'paypoint.get_entry_config.0';
        $this->client->paypoint->getEntryConfig(
            '8cfec329267',
            new GetEntryConfigRequest([]),
            [
                'headers' => [
                    'X-Test-Id' => 'paypoint.get_entry_config.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Paypoint/8cfec329267",
            null,
            1
        );
    }

    /**
     */
    public function testGetPage(): void {
        $testId = 'paypoint.get_page.0';
        $this->client->paypoint->getPage(
            '8cfec329267',
            'pay-your-fees-1',
            [
                'headers' => [
                    'X-Test-Id' => 'paypoint.get_page.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Paypoint/8cfec329267/pay-your-fees-1",
            null,
            1
        );
    }

    /**
     */
    public function testRemovePage(): void {
        $testId = 'paypoint.remove_page.0';
        $this->client->paypoint->removePage(
            '8cfec329267',
            'pay-your-fees-1',
            [
                'headers' => [
                    'X-Test-Id' => 'paypoint.remove_page.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "DELETE",
            "/Paypoint/8cfec329267/pay-your-fees-1",
            null,
            1
        );
    }

    /**
     */
    public function testSaveLogo(): void {
        $testId = 'paypoint.save_logo.0';
        $this->client->paypoint->saveLogo(
            '8cfec329267',
            new FileContent([]),
            [
                'headers' => [
                    'X-Test-Id' => 'paypoint.save_logo.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "PUT",
            "/Paypoint/logo/8cfec329267",
            null,
            1
        );
    }

    /**
     */
    public function testSettingsPage(): void {
        $testId = 'paypoint.settings_page.0';
        $this->client->paypoint->settingsPage(
            '8cfec329267',
            [
                'headers' => [
                    'X-Test-Id' => 'paypoint.settings_page.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Paypoint/settings/8cfec329267",
            null,
            1
        );
    }

    /**
     */
    public function testMigrate(): void {
        $testId = 'paypoint.migrate.0';
        $this->client->paypoint->migrate(
            new PaypointMoveRequest([
                'entryPoint' => '473abc123def',
                'newParentOrganizationId' => 123,
                'notificationRequest' => new NotificationRequest([
                    'notificationUrl' => 'https://webhook-test.yoursie.com',
                    'webHeaderParameters' => [
                        new WebHeaderParameter([
                            'key' => 'testheader',
                            'value' => '1234567890',
                        ]),
                    ],
                ]),
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'paypoint.migrate.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "POST",
            "/Paypoint/migrate",
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
