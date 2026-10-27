<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Traits\OrganizationWritableFields;
use Payabli\Core\Json\JsonProperty;

/**
 * Create an organization and its business together. Provide `business` plus `doingBusinessAs`. All other fields are optional.
 */
class CreateOrganizationWithInlineBusiness extends JsonSerializableType
{
    use OrganizationWritableFields;

    /**
     * @var CreateBusinessRequest $business The business to create inline for the organization. An organization isn't underwritten, so the business needs only the fields that creating a business requires. Include basic details such as `addressDetails`, `emails`, and `phone` when you have them.
     */
    #[JsonProperty('business')]
    public CreateBusinessRequest $business;

    /**
     * @param array{
     *   doingBusinessAs: string,
     *   business: CreateBusinessRequest,
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
        $this->business = $values['business'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
