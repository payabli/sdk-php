<?php

namespace Payabli\Tests;

use Payabli\Tests\Wire\WireMockTestCase;
use Payabli\PayabliClient;
use Payabli\CheckCapture\Requests\CheckCaptureRequestBody;

class CheckCaptureWireTest extends WireMockTestCase
{
    /**
     * @var PayabliClient $client
     */
    private PayabliClient $client;

    /**
     */
    public function testCheckProcessing(): void {
        $testId = 'check_capture.check_processing.0';
        $this->client->checkCapture->checkProcessing(
            new CheckCaptureRequestBody([
                'entryPoint' => '47abcfea12',
                'frontImage' => '/9j/4AAQSkZJRgABAQEASABIAAD...',
                'rearImage' => '/9j/4AAQSkZJRgABAQEASABIAAD...',
                'checkAmount' => 12550,
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'check_capture.check_processing.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "POST",
            "/CheckCapture/CheckProcessing",
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
