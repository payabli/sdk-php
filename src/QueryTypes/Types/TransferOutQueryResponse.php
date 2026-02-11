<?php

namespace Payabli\QueryTypes\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Core\Types\ArrayType;

/**
 * Response body for queries about outbound transfers.
 */
class TransferOutQueryResponse extends JsonSerializableType
{
    /**
     * @var TransferOutSummary $summary Summary information about the transfers.
     */
    #[JsonProperty('Summary')]
    public TransferOutSummary $summary;

    /**
     * @var array<TransferOutRecord> $records List of outbound transfer records.
     */
    #[JsonProperty('Records'), ArrayType([TransferOutRecord::class])]
    public array $records;

    /**
     * @param array{
     *   summary: TransferOutSummary,
     *   records: array<TransferOutRecord>,
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
