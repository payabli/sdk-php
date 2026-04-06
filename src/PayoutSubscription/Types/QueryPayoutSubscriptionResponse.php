<?php

namespace Payabli\PayoutSubscription\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Types\QuerySummary;
use Payabli\Core\Json\JsonProperty;
use Payabli\Core\Types\ArrayType;

/**
 * Payout subscription query response body.
 */
class QueryPayoutSubscriptionResponse extends JsonSerializableType
{
    /**
     * @var ?QuerySummary $summary
     */
    #[JsonProperty('Summary')]
    public ?QuerySummary $summary;

    /**
     * @var ?array<PayoutSubscriptionQueryRecordPascal> $records
     */
    #[JsonProperty('Records'), ArrayType([PayoutSubscriptionQueryRecordPascal::class])]
    public ?array $records;

    /**
     * @param array{
     *   summary?: ?QuerySummary,
     *   records?: ?array<PayoutSubscriptionQueryRecordPascal>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->summary = $values['summary'] ?? null;
        $this->records = $values['records'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
