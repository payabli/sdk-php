<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Traits\OrganizationWritableFields;
use Payabli\Core\Json\JsonProperty;

/**
 * All fields accepted when creating an organization. Provide exactly one of `business` or `businessReference`.
 */
class CreateOrganizationAllFields extends JsonSerializableType
{
    use OrganizationWritableFields;

    /**
     * @var ?CreateBusinessRequest $business The business to create inline for the organization.
     */
    #[JsonProperty('business')]
    public ?CreateBusinessRequest $business;

    /**
     * @var ?string $businessReference The reference of an existing business the organization belongs to.
     */
    #[JsonProperty('businessReference')]
    public ?string $businessReference;

    /**
     * @param array{
     *   doingBusinessAs: string,
     *   parentPaypointReference?: ?string,
     *   description?: ?string,
     *   website?: ?string,
     *   customerServicePhone?: ?string,
     *   customerServiceEmail?: ?string,
     *   timezone?: ?string,
     *   externalId?: ?string,
     *   customData?: ?array<string, mixed>,
     *   business?: ?CreateBusinessRequest,
     *   businessReference?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->parentPaypointReference = $values['parentPaypointReference'] ?? null;
        $this->doingBusinessAs = $values['doingBusinessAs'];
        $this->description = $values['description'] ?? null;
        $this->website = $values['website'] ?? null;
        $this->customerServicePhone = $values['customerServicePhone'] ?? null;
        $this->customerServiceEmail = $values['customerServiceEmail'] ?? null;
        $this->timezone = $values['timezone'] ?? null;
        $this->externalId = $values['externalId'] ?? null;
        $this->customData = $values['customData'] ?? null;
        $this->business = $values['business'] ?? null;
        $this->businessReference = $values['businessReference'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
