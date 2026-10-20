<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Core\Types\ArrayType;

/**
 * The results of a people search.
 */
class PeopleSearchResultsResponse extends JsonSerializableType
{
    /**
     * @var ?array<PeopleSearchResultResponse> $results The matched records.
     */
    #[JsonProperty('results'), ArrayType([PeopleSearchResultResponse::class])]
    public ?array $results;

    /**
     * @var int $total The total number of matches.
     */
    #[JsonProperty('total')]
    public int $total;

    /**
     * @var bool $isEnrichedByVendor Whether the person was sent to the identity vendor for evaluation.
     */
    #[JsonProperty('isEnrichedByVendor')]
    public bool $isEnrichedByVendor;

    /**
     * @param array{
     *   total: int,
     *   isEnrichedByVendor: bool,
     *   results?: ?array<PeopleSearchResultResponse>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->results = $values['results'] ?? null;
        $this->total = $values['total'];
        $this->isEnrichedByVendor = $values['isEnrichedByVendor'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
