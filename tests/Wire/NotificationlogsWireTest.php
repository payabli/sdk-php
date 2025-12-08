<?php

namespace Payabli\Tests;

use Payabli\Tests\Wire\WireMockTestCase;
use Payabli\PayabliClient;
use Payabli\Notificationlogs\Requests\SearchNotificationLogsRequest;
use Payabli\Notificationlogs\Types\NotificationLogSearchRequest;
use DateTime;

class NotificationlogsWireTest extends WireMockTestCase
{
    /**
     * @var PayabliClient $client
     */
    private PayabliClient $client;

    /**
     */
    public function testSearchNotificationLogs(): void {
        $testId = 'notificationlogs.search_notification_logs.0';
        $this->client->notificationlogs->searchNotificationLogs(
            new SearchNotificationLogsRequest([
                'pageSize' => 20,
                'body' => new NotificationLogSearchRequest([
                    'startDate' => new DateTime('2024-01-01T00:00:00Z'),
                    'endDate' => new DateTime('2024-01-31T23:59:59Z'),
                    'orgId' => 12345,
                    'notificationEvent' => 'ActivatedMerchant',
                    'succeeded' => true,
                ]),
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'notificationlogs.search_notification_logs.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "POST",
            "/v2/notificationlogs",
            ['PageSize' => '20'],
            1
        );
    }

    /**
     */
    public function testGetNotificationLog(): void {
        $testId = 'notificationlogs.get_notification_log.0';
        $this->client->notificationlogs->getNotificationLog(
            '550e8400-e29b-41d4-a716-446655440000',
            [
                'headers' => [
                    'X-Test-Id' => 'notificationlogs.get_notification_log.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/v2/notificationlogs/550e8400-e29b-41d4-a716-446655440000",
            null,
            1
        );
    }

    /**
     */
    public function testRetryNotificationLog(): void {
        $testId = 'notificationlogs.retry_notification_log.0';
        $this->client->notificationlogs->retryNotificationLog(
            '550e8400-e29b-41d4-a716-446655440000',
            [
                'headers' => [
                    'X-Test-Id' => 'notificationlogs.retry_notification_log.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/v2/notificationlogs/550e8400-e29b-41d4-a716-446655440000/retry",
            null,
            1
        );
    }

    /**
     */
    public function testBulkRetryNotificationLogs(): void {
        $testId = 'notificationlogs.bulk_retry_notification_logs.0';
        $this->client->notificationlogs->bulkRetryNotificationLogs(
            [
                '550e8400-e29b-41d4-a716-446655440000',
                '550e8400-e29b-41d4-a716-446655440001',
                '550e8400-e29b-41d4-a716-446655440002',
            ],
            [
                'headers' => [
                    'X-Test-Id' => 'notificationlogs.bulk_retry_notification_logs.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "POST",
            "/v2/notificationlogs/retry",
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
