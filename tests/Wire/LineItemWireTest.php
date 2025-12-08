<?php

namespace Payabli\Tests;

use Payabli\Tests\Wire\WireMockTestCase;
use Payabli\PayabliClient;
use Payabli\LineItem\Requests\AddItemRequest;
use Payabli\Types\LineItem;
use Payabli\LineItem\Requests\ListLineItemsRequest;

class LineItemWireTest extends WireMockTestCase
{
    /**
     * @var PayabliClient $client
     */
    private PayabliClient $client;

    /**
     */
    public function testAddItem(): void {
        $testId = 'line_item.add_item.0';
        $this->client->lineItem->addItem(
            '47cae3d74',
            new AddItemRequest([
                'body' => new LineItem([
                    'itemProductCode' => 'M-DEPOSIT',
                    'itemProductName' => 'Materials deposit',
                    'itemDescription' => 'Deposit for materials',
                    'itemCommodityCode' => '010',
                    'itemUnitOfMeasure' => 'SqFt',
                    'itemCost' => 12.45,
                    'itemQty' => 1,
                    'itemMode' => 0,
                ]),
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'line_item.add_item.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "POST",
            "/LineItem/47cae3d74",
            null,
            1
        );
    }

    /**
     */
    public function testDeleteItem(): void {
        $testId = 'line_item.delete_item.0';
        $this->client->lineItem->deleteItem(
            700,
            [
                'headers' => [
                    'X-Test-Id' => 'line_item.delete_item.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "DELETE",
            "/LineItem/700",
            null,
            1
        );
    }

    /**
     */
    public function testGetItem(): void {
        $testId = 'line_item.get_item.0';
        $this->client->lineItem->getItem(
            700,
            [
                'headers' => [
                    'X-Test-Id' => 'line_item.get_item.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/LineItem/700",
            null,
            1
        );
    }

    /**
     */
    public function testListLineItems(): void {
        $testId = 'line_item.list_line_items.0';
        $this->client->lineItem->listLineItems(
            '8cfec329267',
            new ListLineItemsRequest([
                'fromRecord' => 251,
                'limitRecord' => 0,
                'sortBy' => 'desc(field_name)',
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'line_item.list_line_items.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "GET",
            "/Query/lineitems/8cfec329267",
            ['fromRecord' => '251', 'limitRecord' => '0', 'sortBy' => 'desc(field_name)'],
            1
        );
    }

    /**
     */
    public function testUpdateItem(): void {
        $testId = 'line_item.update_item.0';
        $this->client->lineItem->updateItem(
            700,
            new LineItem([
                'itemCost' => 12.45,
                'itemQty' => 1,
            ]),
            [
                'headers' => [
                    'X-Test-Id' => 'line_item.update_item.0',
                ],
            ],
        );
        $this->verifyRequestCount(
            $testId,
            "PUT",
            "/LineItem/700",
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
