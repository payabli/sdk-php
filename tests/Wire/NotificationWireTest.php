<?php

namespace Payabli\Tests;

use Payabli\Tests\Wire\WireMockTestCase;
use Payabli\PayabliClient;
use Payabli\Types\NotificationStandardRequest;
use Payabli\Types\NotificationStandardRequestContent;
use Payabli\Types\NotificationStandardRequestContentEventType;
use Payabli\Types\NotificationStandardRequestFrequency;
use Payabli\Types\NotificationStandardRequestMethod;

class NotificationWireTest extends WireMockTestCase
{
    /**
     * @var PayabliClient $client
     */
    private PayabliClient $client;

    /**
     */
    public function testAddNotification(): void {
        $testId = 'notification.add_notification.0';
        $this->client->notification->addNotification(
            new NotificationStandardRequest([
                'content' => new NotificationStandardRequestContent([
                    'eventType' => NotificationStandardRequestContentEventType::CreatedApplication->value,
                ]),
                'frequency' => NotificationStandardRequestFrequency::Untilcancelled->value,
                'method' => NotificationStandardRequestMethod::Web->value,
                'ownerId' => '236',
                'ownerType' => 0,
                'status' => 1,
                'target' => 'https://webhook.site/2871b8f8-edc7-441a-b376-98d8c8e33275',
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'notification.add_notification.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "POST",
            "/Notification",
            null,
            1
        );
    }

    /**
     */
    public function testDeleteNotification(): void {
        $testId = 'notification.delete_notification.0';
        $this->client->notification->deleteNotification(
            '1717',
            [
                'headers' => [
                    'X-Test-Id' => 'notification.delete_notification.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "DELETE",
            "/Notification/1717",
            null,
            1
        );
    }

    /**
     */
    public function testGetNotification(): void {
        $testId = 'notification.get_notification.0';
        $this->client->notification->getNotification(
            '1717',
            [
                'headers' => [
                    'X-Test-Id' => 'notification.get_notification.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Notification/1717",
            null,
            1
        );
    }

    /**
     */
    public function testUpdateNotification(): void {
        $testId = 'notification.update_notification.0';
        $this->client->notification->updateNotification(
            '1717',
            new NotificationStandardRequest([
                'content' => new NotificationStandardRequestContent([
                    'eventType' => NotificationStandardRequestContentEventType::ApprovedPayment->value,
                ]),
                'frequency' => NotificationStandardRequestFrequency::Untilcancelled->value,
                'method' => NotificationStandardRequestMethod::Email->value,
                'ownerId' => '136',
                'ownerType' => 0,
                'status' => 1,
                'target' => 'newemail@email.com',
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'notification.update_notification.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "PUT",
            "/Notification/1717",
            null,
            1
        );
    }

    /**
     */
    public function testGetReportFile(): void {
        $testId = 'notification.get_report_file.0';
        $this->client->notification->getReportFile(
            1000000,
            [
                'headers' => [
                    'X-Test-Id' => 'notification.get_report_file.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Export/notificationReport/1000000",
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
