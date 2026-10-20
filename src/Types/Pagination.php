<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * Pagination metadata for a list response.
 */
class Pagination extends JsonSerializableType
{
    /**
     * @var ?int $page The current page number.
     */
    #[JsonProperty('page')]
    public ?int $page;

    /**
     * @var ?int $totalPages The total number of pages available.
     */
    #[JsonProperty('totalPages')]
    public ?int $totalPages;

    /**
     * @var ?int $totalRecords The total number of records across all pages.
     */
    #[JsonProperty('totalRecords')]
    public ?int $totalRecords;

    /**
     * @var ?int $pageSize The number of records per page.
     */
    #[JsonProperty('pageSize')]
    public ?int $pageSize;

    /**
     * @var ?bool $hasNext Whether a next page is available.
     */
    #[JsonProperty('hasNext')]
    public ?bool $hasNext;

    /**
     * @var ?bool $hasPrevious Whether a previous page is available.
     */
    #[JsonProperty('hasPrevious')]
    public ?bool $hasPrevious;

    /**
     * @param array{
     *   page?: ?int,
     *   totalPages?: ?int,
     *   totalRecords?: ?int,
     *   pageSize?: ?int,
     *   hasNext?: ?bool,
     *   hasPrevious?: ?bool,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->page = $values['page'] ?? null;
        $this->totalPages = $values['totalPages'] ?? null;
        $this->totalRecords = $values['totalRecords'] ?? null;
        $this->pageSize = $values['pageSize'] ?? null;
        $this->hasNext = $values['hasNext'] ?? null;
        $this->hasPrevious = $values['hasPrevious'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
