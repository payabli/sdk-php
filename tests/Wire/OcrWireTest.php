<?php

namespace Payabli\Tests;

use Payabli\Tests\Wire\WireMockTestCase;
use Payabli\PayabliClient;
use Payabli\Ocr\Types\FileContentImageOnly;

class OcrWireTest extends WireMockTestCase
{
    /**
     * @var PayabliClient $client
     */
    private PayabliClient $client;

    /**
     */
    public function testOcrDocumentForm(): void {
        $testId = 'ocr.ocr_document_form.0';
        $this->client->ocr->ocrDocumentForm(
            'typeResult',
            new FileContentImageOnly([]),
            [
                'headers' => [
                    'X-Test-Id' => 'ocr.ocr_document_form.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "POST",
            "/Import/ocrDocumentForm/typeResult",
            null,
            1
        );
    }

    /**
     */
    public function testOcrDocumentJson(): void {
        $testId = 'ocr.ocr_document_json.0';
        $this->client->ocr->ocrDocumentJson(
            'typeResult',
            new FileContentImageOnly([]),
            [
                'headers' => [
                    'X-Test-Id' => 'ocr.ocr_document_json.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "POST",
            "/Import/ocrDocumentJson/typeResult",
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
