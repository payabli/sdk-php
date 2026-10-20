<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Traits\PaypointWritableFields;
use Payabli\Core\Json\JsonProperty;

/**
 * All fields accepted when creating a paypoint. Provide exactly one of `businessReference` or `business`.
 */
class CreatePaypointAllFields extends JsonSerializableType
{
    use PaypointWritableFields;

    /**
     * @var ?string $businessReference The reference of an existing business the paypoint boards under.
     */
    #[JsonProperty('businessReference')]
    public ?string $businessReference;

    /**
     * @var ?CreateBusinessRequest $business The business to create inline and back the paypoint with.
     */
    #[JsonProperty('business')]
    public ?CreateBusinessRequest $business;

    /**
     * @param array{
     *   doingBusinessAs: string,
     *   parentPaypointReference?: ?string,
     *   paypointType?: ?string,
     *   description?: ?string,
     *   website?: ?string,
     *   customerServicePhone?: ?string,
     *   customerServiceEmail?: ?string,
     *   timezone?: ?string,
     *   externalId?: ?string,
     *   customData?: ?array<string, mixed>,
     *   businessReference?: ?string,
     *   business?: ?CreateBusinessRequest,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->parentPaypointReference = $values['parentPaypointReference'] ?? null;
        $this->paypointType = $values['paypointType'] ?? null;
        $this->doingBusinessAs = $values['doingBusinessAs'];
        $this->description = $values['description'] ?? null;
        $this->website = $values['website'] ?? null;
        $this->customerServicePhone = $values['customerServicePhone'] ?? null;
        $this->customerServiceEmail = $values['customerServiceEmail'] ?? null;
        $this->timezone = $values['timezone'] ?? null;
        $this->externalId = $values['externalId'] ?? null;
        $this->customData = $values['customData'] ?? null;
        $this->businessReference = $values['businessReference'] ?? null;
        $this->business = $values['business'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
