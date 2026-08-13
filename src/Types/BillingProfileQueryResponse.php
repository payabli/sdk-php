<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Core\Types\ArrayType;

/**
 * A page of billing profiles that belong to an organization, returned by the
 * List profiles endpoint. This is the data behind the Profile Library table in
 * the Payabli Portal.
 */
class BillingProfileQueryResponse extends JsonSerializableType
{
    /**
     * @var BillingProfileSummary $summary
     */
    #[JsonProperty('summary')]
    public BillingProfileSummary $summary;

    /**
     * @var array<BillingProfileRecord> $records The billing profiles on this page. Empty when the org has no profiles.
     */
    #[JsonProperty('records'), ArrayType([BillingProfileRecord::class])]
    public array $records;

    /**
     * @param array{
     *   summary: BillingProfileSummary,
     *   records: array<BillingProfileRecord>,
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
