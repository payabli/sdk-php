<?php

namespace Payabli\Tests;

use Payabli\Tests\Wire\WireMockTestCase;
use Payabli\PayabliClient;
use Payabli\Customer\Requests\AddCustomerRequest;
use Payabli\Types\CustomerData;

class CustomerWireTest extends WireMockTestCase
{
    /**
     * @var PayabliClient $client
     */
    private PayabliClient $client;

    /**
     */
    public function testAddCustomer(): void {
        $testId = 'customer.add_customer.0';
        $this->client->customer->addCustomer(
            '8cfec329267',
            new AddCustomerRequest([
                'body' => new CustomerData([
                    'customerNumber' => '12356ACB',
                    'firstname' => 'Irene',
                    'lastname' => 'Canizales',
                    'address1' => "123 Bishop's Trail",
                    'city' => 'Mountain City',
                    'state' => 'TN',
                    'zip' => '37612',
                    'country' => 'US',
                    'email' => 'irene@canizalesconcrete.com',
                    'identifierFields' => [
                        'email',
                    ],
                    'timeZone' => -5,
                ]),
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'customer.add_customer.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "POST",
            "/Customer/single/8cfec329267",
            null,
            1
        );
    }

    /**
     */
    public function testDeleteCustomer(): void {
        $testId = 'customer.delete_customer.0';
        $this->client->customer->deleteCustomer(
            998,
            [
                'headers' => [
                    'X-Test-Id' => 'customer.delete_customer.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "DELETE",
            "/Customer/998",
            null,
            1
        );
    }

    /**
     */
    public function testGetCustomer(): void {
        $testId = 'customer.get_customer.0';
        $this->client->customer->getCustomer(
            998,
            [
                'headers' => [
                    'X-Test-Id' => 'customer.get_customer.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Customer/998",
            null,
            1
        );
    }

    /**
     */
    public function testLinkCustomerTransaction(): void {
        $testId = 'customer.link_customer_transaction.0';
        $this->client->customer->linkCustomerTransaction(
            998,
            '45-as456777hhhhhhhhhh77777777-324',
            [
                'headers' => [
                    'X-Test-Id' => 'customer.link_customer_transaction.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Customer/link/998/45-as456777hhhhhhhhhh77777777-324",
            null,
            1
        );
    }

    /**
     */
    public function testRequestConsent(): void {
        $testId = 'customer.request_consent.0';
        $this->client->customer->requestConsent(
            998,
            [
                'headers' => [
                    'X-Test-Id' => 'customer.request_consent.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "POST",
            "/Customer/998/consent",
            null,
            1
        );
    }

    /**
     */
    public function testUpdateCustomer(): void {
        $testId = 'customer.update_customer.0';
        $this->client->customer->updateCustomer(
            998,
            new CustomerData([
                'firstname' => 'Irene',
                'lastname' => 'Canizales',
                'address1' => "145 Bishop's Trail",
                'city' => 'Mountain City',
                'state' => 'TN',
                'zip' => '37612',
                'country' => 'US',
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'customer.update_customer.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "PUT",
            "/Customer/998",
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
