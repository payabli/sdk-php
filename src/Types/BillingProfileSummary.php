<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * Pagination summary for the profile list.
 */
class BillingProfileSummary extends JsonSerializableType
{
    /**
     * @var string $pageIdentifier Opaque identifier for the returned page.
     */
    #[JsonProperty('pageIdentifier')]
    public string $pageIdentifier;

    /**
     * @var int $pageSize Maximum number of records per page.
     */
    #[JsonProperty('pageSize')]
    public int $pageSize;

    /**
     * @var int $totalPages Total number of pages available.
     */
    #[JsonProperty('totalPages')]
    public int $totalPages;

    /**
     * @var int $totalRecords Total number of profiles matching the query.
     */
    #[JsonProperty('totalRecords')]
    public int $totalRecords;

    /**
     * @param array{
     *   pageIdentifier: string,
     *   pageSize: int,
     *   totalPages: int,
     *   totalRecords: int,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->pageIdentifier = $values['pageIdentifier'];
        $this->pageSize = $values['pageSize'];
        $this->totalPages = $values['totalPages'];
        $this->totalRecords = $values['totalRecords'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
