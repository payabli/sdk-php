<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * Pagination metadata for a template list response.
 */
class TemplatesSummary extends JsonSerializableType
{
    /**
     * @var int $totalPages The total number of pages available.
     */
    #[JsonProperty('totalPages')]
    public int $totalPages;

    /**
     * @var int $totalRecords The total number of templates across all pages.
     */
    #[JsonProperty('totalRecords')]
    public int $totalRecords;

    /**
     * @var int $pageSize The number of templates per page.
     */
    #[JsonProperty('pageSize')]
    public int $pageSize;

    /**
     * @param array{
     *   totalPages: int,
     *   totalRecords: int,
     *   pageSize: int,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->totalPages = $values['totalPages'];
        $this->totalRecords = $values['totalRecords'];
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
