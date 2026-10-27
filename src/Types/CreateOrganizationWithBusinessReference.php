<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Traits\OrganizationWritableFields;
use Payabli\Core\Json\JsonProperty;

/**
 * Create an organization under an existing business. Provide `businessReference` plus `doingBusinessAs`. All other fields are optional.
 */
class CreateOrganizationWithBusinessReference extends JsonSerializableType
{
    use OrganizationWritableFields;

    /**
     * @var string $businessReference The reference of the existing business the organization belongs to.
     */
    #[JsonProperty('businessReference')]
    public string $businessReference;

    /**
     * @param array{
     *   doingBusinessAs: string,
     *   businessReference: string,
     *   parentPaypointReference?: ?string,
     *   description?: ?string,
     *   website?: ?string,
     *   customerServicePhone?: ?string,
     *   customerServiceEmail?: ?string,
     *   timezone?: ?string,
     *   externalId?: ?string,
     *   customData?: ?array<string, mixed>,
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
        $this->businessReference = $values['businessReference'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
