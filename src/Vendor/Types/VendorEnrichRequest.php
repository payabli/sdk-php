<?php

namespace Payabli\Vendor\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Core\Types\ArrayType;
use Payabli\Types\FileContent;

/**
 * Request body for the vendor enrichment endpoint.
 */
class VendorEnrichRequest extends JsonSerializableType
{
    /**
     * @var int $vendorId ID of the vendor to enrich. Must be active and belong to the given entrypoint.
     */
    #[JsonProperty('vendorId')]
    public int $vendorId;

    /**
     * @var ?array<string> $scope Enrichment stages to run. Valid values are `invoice_scan` and `web_search`. Stages run in order: invoice scan first, then web search. If the vendor becomes payout-ready after invoice scan, web search is skipped.
     */
    #[JsonProperty('scope'), ArrayType(['string'])]
    public ?array $scope;

    /**
     * @var ?bool $applyEnrichmentData When `true` (the default), extracted data is automatically written to the vendor record. Only empty fields are populated, existing values are never overwritten. When `false`, the vendor record isn't modified. In both cases, `enrichmentData` in the response contains the extracted results. Use `false` for UI flows where users review and confirm changes before applying them with the update vendor endpoint.
     */
    #[JsonProperty('applyEnrichmentData')]
    public ?bool $applyEnrichmentData;

    /**
     * @var ?bool $scheduleCallIfNeeded When `true`, triggers an AI outreach call if enrichment stages return insufficient payment acceptance info. This feature is currently in development.
     */
    #[JsonProperty('scheduleCallIfNeeded')]
    public ?bool $scheduleCallIfNeeded;

    /**
     * @var ?FileContent $invoiceFile PDF invoice file, Base64-encoded. Required when `scope` includes `invoice_scan`.
     */
    #[JsonProperty('invoiceFile')]
    public ?FileContent $invoiceFile;

    /**
     * @var ?int $billId Bill ID to associate with this enrichment request.
     */
    #[JsonProperty('billId')]
    public ?int $billId;

    /**
     * @var ?string $fallbackMethod Payment method to apply if enrichment can't find payment details. Values are `check`, `ach`, or `card`.
     */
    #[JsonProperty('fallbackMethod')]
    public ?string $fallbackMethod;

    /**
     * @param array{
     *   vendorId: int,
     *   scope?: ?array<string>,
     *   applyEnrichmentData?: ?bool,
     *   scheduleCallIfNeeded?: ?bool,
     *   invoiceFile?: ?FileContent,
     *   billId?: ?int,
     *   fallbackMethod?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->vendorId = $values['vendorId'];
        $this->scope = $values['scope'] ?? null;
        $this->applyEnrichmentData = $values['applyEnrichmentData'] ?? null;
        $this->scheduleCallIfNeeded = $values['scheduleCallIfNeeded'] ?? null;
        $this->invoiceFile = $values['invoiceFile'] ?? null;
        $this->billId = $values['billId'] ?? null;
        $this->fallbackMethod = $values['fallbackMethod'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
