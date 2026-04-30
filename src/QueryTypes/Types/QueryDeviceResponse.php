<?php

namespace Payabli\QueryTypes\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Types\QuerySummary;
use Payabli\Core\Json\JsonProperty;
use Payabli\Core\Types\ArrayType;

/**
 * Response body for queries about cloud devices.
 */
class QueryDeviceResponse extends JsonSerializableType
{
    /**
     * @var QuerySummary $summary
     */
    #[JsonProperty('Summary')]
    public QuerySummary $summary;

    /**
     * @var array<DeviceQueryRecord> $records
     */
    #[JsonProperty('Records'), ArrayType([DeviceQueryRecord::class])]
    public array $records;

    /**
     * @param array{
     *   summary: QuerySummary,
     *   records: array<DeviceQueryRecord>,
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
