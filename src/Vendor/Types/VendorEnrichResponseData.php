<?php

namespace Payabli\Vendor\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Core\Types\ArrayType;

/**
 * Enrichment result details.
 */
class VendorEnrichResponseData extends JsonSerializableType
{
    /**
     * @var ?string $enrichmentId Unique identifier for this enrichment run. Format: `enrich-{vendorId}-{8-char hex}`.
     */
    #[JsonProperty('enrichmentId')]
    public ?string $enrichmentId;

    /**
     * @var ?string $status Final enrichment status. Values are `completed` (vendor is payout-ready), `completed_from_network` (vendor was already enriched in the Payabli vendor network, no AI processing needed), or `insufficient` (all stages ran but the vendor still lacks sufficient payment data).
     */
    #[JsonProperty('status')]
    public ?string $status;

    /**
     * @var ?array<string> $stagesTriggered Stages that ran successfully. A stage is only listed here if it returned a successful response. Failed stages are excluded.
     */
    #[JsonProperty('stagesTriggered'), ArrayType(['string'])]
    public ?array $stagesTriggered;

    /**
     * @var ?bool $vendorPayoutReady `true` if the vendor now has sufficient payment data to process a payout (ACH, card email, or check remit address).
     */
    #[JsonProperty('vendorPayoutReady')]
    public ?bool $vendorPayoutReady;

    /**
     * @var ?VendorEnrichmentData $enrichmentData Raw extraction results from the enrichment stages that ran.
     */
    #[JsonProperty('enrichmentData')]
    public ?VendorEnrichmentData $enrichmentData;

    /**
     * @param array{
     *   enrichmentId?: ?string,
     *   status?: ?string,
     *   stagesTriggered?: ?array<string>,
     *   vendorPayoutReady?: ?bool,
     *   enrichmentData?: ?VendorEnrichmentData,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->enrichmentId = $values['enrichmentId'] ?? null;
        $this->status = $values['status'] ?? null;
        $this->stagesTriggered = $values['stagesTriggered'] ?? null;
        $this->vendorPayoutReady = $values['vendorPayoutReady'] ?? null;
        $this->enrichmentData = $values['enrichmentData'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
