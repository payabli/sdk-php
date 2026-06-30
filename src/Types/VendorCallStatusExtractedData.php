<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * Data extracted from a completed outreach call.
 */
class VendorCallStatusExtractedData extends JsonSerializableType
{
    /**
     * @var ?string $selectedPaymentMethod Payment method the vendor said they accept. Values are `card`, `ach`, or `check`.
     */
    #[JsonProperty('selectedPaymentMethod')]
    public ?string $selectedPaymentMethod;

    /**
     * @var ?string $contactEmail Contact email collected during the call.
     */
    #[JsonProperty('contactEmail')]
    public ?string $contactEmail;

    /**
     * @param array{
     *   selectedPaymentMethod?: ?string,
     *   contactEmail?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->selectedPaymentMethod = $values['selectedPaymentMethod'] ?? null;
        $this->contactEmail = $values['contactEmail'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
