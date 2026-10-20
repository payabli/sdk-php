<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Core\Types\ArrayType;

/**
 * A page of applications.
 */
class ListApplicationsResponse extends JsonSerializableType
{
    /**
     * @var ?array<ApplicationListItem> $data The applications on this page.
     */
    #[JsonProperty('data'), ArrayType([ApplicationListItem::class])]
    public ?array $data;

    /**
     * @var int $total The total number of applications across all pages.
     */
    #[JsonProperty('total')]
    public int $total;

    /**
     * @var int $page The current page number.
     */
    #[JsonProperty('page')]
    public int $page;

    /**
     * @var int $pageSize The number of applications per page.
     */
    #[JsonProperty('pageSize')]
    public int $pageSize;

    /**
     * @param array{
     *   total: int,
     *   page: int,
     *   pageSize: int,
     *   data?: ?array<ApplicationListItem>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->data = $values['data'] ?? null;
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
