<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Core\Types\ArrayType;

/**
 * A paginated list of cases.
 */
class CaseListResponse extends JsonSerializableType
{
    /**
     * @var CaseListSummary $summary
     */
    #[JsonProperty('summary')]
    public CaseListSummary $summary;

    /**
     * @var array<CaseResponse> $records The cases on this page. Each record is a full case object.
     */
    #[JsonProperty('records'), ArrayType([CaseResponse::class])]
    public array $records;

    /**
     * @param array{
     *   summary: CaseListSummary,
     *   records: array<CaseResponse>,
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
