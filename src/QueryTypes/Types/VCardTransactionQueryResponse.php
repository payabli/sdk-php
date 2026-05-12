<?php

namespace Payabli\QueryTypes\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Types\VCardSummary;
use Payabli\Core\Json\JsonProperty;
use Payabli\Core\Types\ArrayType;

/**
 * Response body for queries about virtual card transactions.
 */
class VCardTransactionQueryResponse extends JsonSerializableType
{
    /**
     * @var VCardSummary $summary
     */
    #[JsonProperty('Summary')]
    public VCardSummary $summary;

    /**
     * @var array<VCardTransactionRecord> $records
     */
    #[JsonProperty('Records'), ArrayType([VCardTransactionRecord::class])]
    public array $records;

    /**
     * @param array{
     *   summary: VCardSummary,
     *   records: array<VCardTransactionRecord>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->summary = $values['summary'];
        $this->records = $values['records'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
