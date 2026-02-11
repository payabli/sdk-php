<?php

namespace Payabli\QueryTypes\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Core\Types\ArrayType;

/**
 * Response body for queries about outbound transfer details.
 */
class TransferOutDetailQueryResponse extends JsonSerializableType
{
    /**
     * @var QueryTransferSummary $summary Summary information about the transfer details.
     */
    #[JsonProperty('Summary')]
    public QueryTransferSummary $summary;

    /**
     * @var array<TransferOutDetailRecord> $records List of outbound transfer detail records.
     */
    #[JsonProperty('Records'), ArrayType([TransferOutDetailRecord::class])]
    public array $records;

    /**
     * @param array{
     *   summary: QueryTransferSummary,
     *   records: array<TransferOutDetailRecord>,
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
