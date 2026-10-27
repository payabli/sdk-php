<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Core\Types\ArrayType;

/**
 * Fields you can set when you create an organization. Payabli sets the organization type, so the request has no `paypointType`. Of these shared fields, only `doingBusinessAs` is required. Set `description`, `website`, `customerServicePhone`, `customerServiceEmail`, and `timezone` when you have them.
 */
class OrganizationWritableFields extends JsonSerializableType
{
    /**
     * @var ?string $parentPaypointReference The reference of the parent organization this organization nests under. If you omit it, the organization nests under the organization your credential belongs to.
     */
    #[JsonProperty('parentPaypointReference')]
    public ?string $parentPaypointReference;

    /**
     * @var string $doingBusinessAs The name the organization does business as (DBA).
     */
    #[JsonProperty('doingBusinessAs')]
    public string $doingBusinessAs;

    /**
     * @var ?string $description A free-text description of the organization.
     */
    #[JsonProperty('description')]
    public ?string $description;

    /**
     * @var ?string $website The organization's website URL.
     */
    #[JsonProperty('website')]
    public ?string $website;

    /**
     * @var ?string $customerServicePhone The customer service phone number.
     */
    #[JsonProperty('customerServicePhone')]
    public ?string $customerServicePhone;

    /**
     * @var ?string $customerServiceEmail The customer service email address.
     */
    #[JsonProperty('customerServiceEmail')]
    public ?string $customerServiceEmail;

    /**
     * @var ?string $timezone The organization's time zone, as an IANA identifier such as `America/Chicago`.
     */
    #[JsonProperty('timezone')]
    public ?string $timezone;

    /**
     * @var ?string $externalId Your own identifier for the organization.
     */
    #[JsonProperty('externalId')]
    public ?string $externalId;

    /**
     * @var ?array<string, mixed> $customData Arbitrary key-value data you attach to the organization.
     */
    #[JsonProperty('customData'), ArrayType(['string' => 'mixed'])]
    public ?array $customData;

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
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
