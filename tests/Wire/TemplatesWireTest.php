<?php

namespace Payabli\Tests;

use Payabli\Tests\Wire\WireMockTestCase;
use Payabli\PayabliClient;
use Payabli\Templates\Requests\ListTemplatesRequest;

class TemplatesWireTest extends WireMockTestCase
{
    /**
     * @var PayabliClient $client
     */
    private PayabliClient $client;

    /**
     */
    public function testDeleteTemplate(): void {
        $testId = 'templates.delete_template.0';
        $this->client->templates->deleteTemplate(
            80,
            [
                'headers' => [
                    'X-Test-Id' => 'templates.delete_template.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "DELETE",
            "/Templates/80",
            null,
            1
        );
    }

    /**
     */
    public function testGetlinkTemplate(): void {
        $testId = 'templates.getlink_template.0';
        $this->client->templates->getlinkTemplate(
            true,
            80,
            [
                'headers' => [
                    'X-Test-Id' => 'templates.getlink_template.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Templates/getlink/80/true",
            null,
            1
        );
    }

    /**
     */
    public function testGetTemplate(): void {
        $testId = 'templates.get_template.0';
        $this->client->templates->getTemplate(
            80,
            [
                'headers' => [
                    'X-Test-Id' => 'templates.get_template.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Templates/get/80",
            null,
            1
        );
    }

    /**
     */
    public function testListTemplates(): void {
        $testId = 'templates.list_templates.0';
        $this->client->templates->listTemplates(
            123,
            new ListTemplatesRequest([
                'fromRecord' => 251,
                'limitRecord' => 0,
                'sortBy' => 'desc(field_name)',
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'templates.list_templates.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Query/templates/123",
            ['fromRecord' => '251', 'limitRecord' => '0', 'sortBy' => 'desc(field_name)'],
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
