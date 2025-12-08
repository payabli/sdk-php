<?php

namespace Payabli\Tests;

use Payabli\Tests\Wire\WireMockTestCase;
use Payabli\PayabliClient;
use Payabli\TokenStorage\Requests\AddMethodRequest;
use Payabli\TokenStorage\Types\RequestTokenStorage;
use Payabli\Types\PayorDataRequest;
use Payabli\TokenStorage\Types\TokenizeCard;
use Payabli\TokenStorage\Requests\GetMethodRequest;
use Payabli\TokenStorage\Requests\UpdateMethodRequest;

class TokenStorageWireTest extends WireMockTestCase
{
    /**
     * @var PayabliClient $client
     */
    private PayabliClient $client;

    /**
     */
    public function testAddMethod(): void {
        $testId = 'token_storage.add_method.0';
        $this->client->tokenStorage->addMethod(
            new AddMethodRequest([
                'body' => new RequestTokenStorage([
                    'customerData' => new PayorDataRequest([
                        'customerId' => 4440,
                    ]),
                    'entryPoint' => 'f743aed24a',
                    'fallbackAuth' => true,
                    'paymentMethod' => new TokenizeCard([
                        'cardcvv' => '123',
                        'cardexp' => '02/25',
                        'cardHolder' => 'John Doe',
                        'cardnumber' => '4111111111111111',
                        'cardzip' => '12345',
                        'method' => 'card',
                    ]),
                ]),
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'token_storage.add_method.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "POST",
            "/TokenStorage/add",
            null,
            1
        );
    }

    /**
     */
    public function testGetMethod(): void {
        $testId = 'token_storage.get_method.0';
        $this->client->tokenStorage->getMethod(
            '32-8877drt00045632-678',
            new GetMethodRequest([
                'cardExpirationFormat' => 1,
                'includeTemporary' => false,
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'token_storage.get_method.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/TokenStorage/32-8877drt00045632-678",
            ['cardExpirationFormat' => '1', 'includeTemporary' => 'false'],
            1
        );
    }

    /**
     */
    public function testRemoveMethod(): void {
        $testId = 'token_storage.remove_method.0';
        $this->client->tokenStorage->removeMethod(
            '32-8877drt00045632-678',
            [
                'headers' => [
                    'X-Test-Id' => 'token_storage.remove_method.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "DELETE",
            "/TokenStorage/32-8877drt00045632-678",
            null,
            1
        );
    }

    /**
     */
    public function testUpdateMethod(): void {
        $testId = 'token_storage.update_method.0';
        $this->client->tokenStorage->updateMethod(
            '32-8877drt00045632-678',
            new UpdateMethodRequest([
                'body' => new RequestTokenStorage([
                    'customerData' => new PayorDataRequest([
                        'customerId' => 4440,
                    ]),
                    'entryPoint' => 'f743aed24a',
                    'fallbackAuth' => true,
                    'paymentMethod' => new TokenizeCard([
                        'cardcvv' => '123',
                        'cardexp' => '02/25',
                        'cardHolder' => 'John Doe',
                        'cardnumber' => '4111111111111111',
                        'cardzip' => '12345',
                        'method' => 'card',
                    ]),
                ]),
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'token_storage.update_method.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "PUT",
            "/TokenStorage/32-8877drt00045632-678",
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
