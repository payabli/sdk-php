<?php

namespace Payabli\Tests;

use Payabli\Tests\Wire\WireMockTestCase;
use Payabli\PayabliClient;
use Payabli\Subscription\Requests\RequestSchedule;
use Payabli\Subscription\Types\SubscriptionRequestBody;
use Payabli\Types\PayorDataRequest;
use Payabli\Types\PaymentDetail;
use Payabli\Types\PayMethodCredit;
use Payabli\Types\ScheduleDetail;
use Payabli\Types\Frequency;
use Payabli\Subscription\Requests\RequestUpdateSchedule;

class SubscriptionWireTest extends WireMockTestCase
{
    /**
     * @var PayabliClient $client
     */
    private PayabliClient $client;

    /**
     */
    public function testGetSubscription(): void {
        $testId = 'subscription.get_subscription.0';
        $this->client->subscription->getSubscription(
            263,
            [
                'headers' => [
                    'X-Test-Id' => 'subscription.get_subscription.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Subscription/263",
            null,
            1
        );
    }

    /**
     */
    public function testNewSubscription(): void {
        $testId = 'subscription.new_subscription.0';
        $this->client->subscription->newSubscription(
            new RequestSchedule([
                'body' => new SubscriptionRequestBody([
                    'customerData' => new PayorDataRequest([
                        'customerId' => 4440,
                    ]),
                    'entryPoint' => 'f743aed24a',
                    'paymentDetails' => new PaymentDetail([
                        'serviceFee' => 0,
                        'totalAmount' => 100,
                    ]),
                    'paymentMethod' => new PayMethodCredit([
                        'cardcvv' => '123',
                        'cardexp' => '02/25',
                        'cardHolder' => 'John Cassian',
                        'cardnumber' => '4111111111111111',
                        'cardzip' => '37615',
                        'initiator' => 'payor',
                        'method' => 'card',
                    ]),
                    'scheduleDetails' => new ScheduleDetail([
                        'endDate' => '03-20-2025',
                        'frequency' => Frequency::Weekly->value,
                        'planId' => 1,
                        'startDate' => '09-20-2024',
                    ]),
                ]),
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'subscription.new_subscription.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "POST",
            "/Subscription/add",
            null,
            1
        );
    }

    /**
     */
    public function testRemoveSubscription(): void {
        $testId = 'subscription.remove_subscription.0';
        $this->client->subscription->removeSubscription(
            396,
            [
                'headers' => [
                    'X-Test-Id' => 'subscription.remove_subscription.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "DELETE",
            "/Subscription/396",
            null,
            1
        );
    }

    /**
     */
    public function testUpdateSubscription(): void {
        $testId = 'subscription.update_subscription.0';
        $this->client->subscription->updateSubscription(
            231,
            new RequestUpdateSchedule([
                'setPause' => true,
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'subscription.update_subscription.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "PUT",
            "/Subscription/231",
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
