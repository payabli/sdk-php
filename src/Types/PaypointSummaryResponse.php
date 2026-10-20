<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * A paypoint as it appears in a list response.
 */
class PaypointSummaryResponse extends JsonSerializableType
{
    /**
     * @var string $paypointReference The paypoint reference.
     */
    #[JsonProperty('paypointReference')]
    public string $paypointReference;

    /**
     * @var ?string $businessReference The reference of the business the paypoint belongs to.
     */
    #[JsonProperty('businessReference')]
    public ?string $businessReference;

    /**
     * @var string $parentPaypointReference The reference of the parent paypoint this paypoint nests under. For a merchant boarded directly under an organization, this is the organization, which is itself a paypoint.
     */
    #[JsonProperty('parentPaypointReference')]
    public string $parentPaypointReference;

    /**
     * @var ?string $paypointType The paypoint type, for example `merchant`.
     */
    #[JsonProperty('paypointType')]
    public ?string $paypointType;

    /**
     * @var string $paypointStatus The paypoint's current status.
     */
    #[JsonProperty('paypointStatus')]
    public string $paypointStatus;

    /**
     * @var ?string $doingBusinessAs The name the paypoint does business as (DBA).
     */
    #[JsonProperty('doingBusinessAs')]
    public ?string $doingBusinessAs;

    /**
     * @var ?string $description A free-text description of the paypoint.
     */
    #[JsonProperty('description')]
    public ?string $description;

    /**
     * @var ?string $website The paypoint's website URL.
     */
    #[JsonProperty('website')]
    public ?string $website;

    /**
     * @var ?string $timezone The paypoint's time zone.
     */
    #[JsonProperty('timezone')]
    public ?string $timezone;

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
     * @var string $entryName The paypoint's entrypoint name, used as the `entry` value on endpoints that target the paypoint.
     */
    #[JsonProperty('entryName')]
    public string $entryName;

    /**
     * @var string $createdAt When the paypoint was created.
     */
    #[JsonProperty('createdAt')]
    public string $createdAt;

    /**
     * @var string $updatedAt When the paypoint was last updated.
     */
    #[JsonProperty('updatedAt')]
    public string $updatedAt;

    /**
     * @var PaypointLinks $links Hypermedia links for the paypoint resource.
     */
    #[JsonProperty('_links')]
    public PaypointLinks $links;

    /**
     * @param array{
     *   paypointReference: string,
     *   parentPaypointReference: string,
     *   paypointStatus: string,
     *   entryName: string,
     *   createdAt: string,
     *   updatedAt: string,
     *   links: PaypointLinks,
     *   businessReference?: ?string,
     *   paypointType?: ?string,
     *   doingBusinessAs?: ?string,
     *   description?: ?string,
     *   website?: ?string,
     *   timezone?: ?string,
     *   customerServicePhone?: ?string,
     *   customerServiceEmail?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->paypointReference = $values['paypointReference'];
        $this->businessReference = $values['businessReference'] ?? null;
        $this->parentPaypointReference = $values['parentPaypointReference'];
        $this->paypointType = $values['paypointType'] ?? null;
        $this->paypointStatus = $values['paypointStatus'];
        $this->doingBusinessAs = $values['doingBusinessAs'] ?? null;
        $this->description = $values['description'] ?? null;
        $this->website = $values['website'] ?? null;
        $this->timezone = $values['timezone'] ?? null;
        $this->customerServicePhone = $values['customerServicePhone'] ?? null;
        $this->customerServiceEmail = $values['customerServiceEmail'] ?? null;
        $this->entryName = $values['entryName'];
        $this->createdAt = $values['createdAt'];
        $this->updatedAt = $values['updatedAt'];
        $this->links = $values['links'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
