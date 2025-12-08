<?php

namespace Payabli\Tests;

use Payabli\Tests\Wire\WireMockTestCase;
use Payabli\PayabliClient;
use Payabli\ChargeBacks\Requests\ResponseChargeBack;

class ChargeBacksWireTest extends WireMockTestCase
{
    /**
     * @var PayabliClient $client
     */
    private PayabliClient $client;

    /**
     */
    public function testAddResponse(): void {
        $testId = 'charge_backs.add_response.0';
        $this->client->chargeBacks->addResponse(
            1000000,
            new ResponseChargeBack([
                'idempotencyKey' => '6B29FC40-CA47-1067-B31D-00DD010662DA',
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'charge_backs.add_response.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "POST",
            "/ChargeBacks/response/1000000",
            null,
            1
        );
    }

    /**
     */
    public function testGetChargeback(): void {
        $testId = 'charge_backs.get_chargeback.0';
        $this->client->chargeBacks->getChargeback(
            1000000,
            [
                'headers' => [
                    'X-Test-Id' => 'charge_backs.get_chargeback.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/ChargeBacks/read/1000000",
            null,
            1
        );
    }

    /**
     */
    public function testGetChargebackAttachment(): void {
        $testId = 'charge_backs.get_chargeback_attachment.0';
        $this->client->chargeBacks->getChargebackAttachment(
            1000000,
            'fileName',
            [
                'headers' => [
                    'X-Test-Id' => 'charge_backs.get_chargeback_attachment.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/ChargeBacks/getChargebackAttachments/1000000/fileName",
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
