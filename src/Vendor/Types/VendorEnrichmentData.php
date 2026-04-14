<?php

namespace Payabli\Vendor\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * Container for enrichment stage results.
 */
class VendorEnrichmentData extends JsonSerializableType
{
    /**
     * @var ?VendorEnrichmentInvoiceScan $invoiceScan Results from the invoice scan stage, if it ran.
     */
    #[JsonProperty('invoiceScan')]
    public ?VendorEnrichmentInvoiceScan $invoiceScan;

    /**
     * @var ?VendorEnrichmentWebSearch $webSearch Results from the web search stage, if it ran.
     */
    #[JsonProperty('webSearch')]
    public ?VendorEnrichmentWebSearch $webSearch;

    /**
     * @param array{
     *   invoiceScan?: ?VendorEnrichmentInvoiceScan,
     *   webSearch?: ?VendorEnrichmentWebSearch,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->invoiceScan = $values['invoiceScan'] ?? null;
        $this->webSearch = $values['webSearch'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
