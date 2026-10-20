<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Core\Types\ArrayType;

/**
 * A page of paypoints.
 */
class ListPaypointsResponse extends JsonSerializableType
{
    /**
     * @var ?array<PaypointSummaryResponse> $items The paypoints on this page.
     */
    #[JsonProperty('items'), ArrayType([PaypointSummaryResponse::class])]
    public ?array $items;

    /**
     * @var int $total The total number of paypoints across all pages.
     */
    #[JsonProperty('total')]
    public int $total;

    /**
     * @var int $page The current page number.
     */
    #[JsonProperty('page')]
    public int $page;

    /**
     * @var int $pageSize The number of paypoints per page.
     */
    #[JsonProperty('pageSize')]
    public int $pageSize;

    /**
     * @param array{
     *   total: int,
     *   page: int,
     *   pageSize: int,
     *   items?: ?array<PaypointSummaryResponse>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->items = $values['items'] ?? null;
        $this->total = $values['total'];
        $this->page = $values['page'];
        $this->pageSize = $values['pageSize'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
