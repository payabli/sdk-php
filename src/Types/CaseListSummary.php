<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * Pagination and totals for a case list response.
 */
class CaseListSummary extends JsonSerializableType
{
    /**
     * @var int $totalRecords The total number of matching cases.
     */
    #[JsonProperty('totalRecords')]
    public int $totalRecords;

    /**
     * @var float $totalAmount Not used for cases; returned as part of the shared list envelope.
     */
    #[JsonProperty('totalAmount')]
    public float $totalAmount;

    /**
     * @var float $totalNetAmount Not used for cases; returned as part of the shared list envelope.
     */
    #[JsonProperty('totalNetAmount')]
    public float $totalNetAmount;

    /**
     * @var int $totalPages The total number of pages.
     */
    #[JsonProperty('totalPages')]
    public int $totalPages;

    /**
     * @var int $pageSize The number of records per page.
     */
    #[JsonProperty('pageSize')]
    public int $pageSize;

    /**
     * @var ?string $pageidentifier An opaque page identifier, when present.
     */
    #[JsonProperty('pageidentifier')]
    public ?string $pageidentifier;

    /**
     * @param array{
     *   totalRecords: int,
     *   totalAmount: float,
     *   totalNetAmount: float,
     *   totalPages: int,
     *   pageSize: int,
     *   pageidentifier?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->totalRecords = $values['totalRecords'];
        $this->totalAmount = $values['totalAmount'];
        $this->totalNetAmount = $values['totalNetAmount'];
        $this->totalPages = $values['totalPages'];
        $this->pageSize = $values['pageSize'];
        $this->pageidentifier = $values['pageidentifier'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
