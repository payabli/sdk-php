<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * The validation result for each section of the application.
 */
class ValidationSections extends JsonSerializableType
{
    /**
     * @var ValidationSection $business The business's details.
     */
    #[JsonProperty('business')]
    public ValidationSection $business;

    /**
     * @var ValidationSection $salesAndPayments The business's processing details, such as volumes and transaction sizes.
     */
    #[JsonProperty('salesAndPayments')]
    public ValidationSection $salesAndPayments;

    /**
     * @var ValidationSection $banking The business's payment methods.
     */
    #[JsonProperty('banking')]
    public ValidationSection $banking;

    /**
     * @var ValidationSection $people The business's owners and officers.
     */
    #[JsonProperty('people')]
    public ValidationSection $people;

    /**
     * @param array{
     *   business: ValidationSection,
     *   salesAndPayments: ValidationSection,
     *   banking: ValidationSection,
     *   people: ValidationSection,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->business = $values['business'];
        $this->salesAndPayments = $values['salesAndPayments'];
        $this->banking = $values['banking'];
        $this->people = $values['people'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
