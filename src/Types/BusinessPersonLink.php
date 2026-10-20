<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use DateTime;
use Payabli\Core\Types\Date;

/**
 * A person's link to a business, with the relationship's role, ownership, and relationship-scoped contact details.
 */
class BusinessPersonLink extends JsonSerializableType
{
    /**
     * @var string $businessReference The reference of the linked business.
     */
    #[JsonProperty('businessReference')]
    public string $businessReference;

    /**
     * @var string $personReference The reference of the linked person.
     */
    #[JsonProperty('personReference')]
    public string $personReference;

    /**
     * @var string $personType The person's role on the business, returned in lowercase (for example `owner`).
     */
    #[JsonProperty('personType')]
    public string $personType;

    /**
     * @var ?float $ownershipPercentage The person's ownership percentage (0 to 100). Present for owners.
     */
    #[JsonProperty('ownershipPercentage')]
    public ?float $ownershipPercentage;

    /**
     * @var bool $beneficialOwner Whether the person qualifies as a beneficial owner. Derived by Payabli.
     */
    #[JsonProperty('beneficialOwner')]
    public bool $beneficialOwner;

    /**
     * @var bool $isPrimaryController Whether the person is the business's primary controller.
     */
    #[JsonProperty('isPrimaryController')]
    public bool $isPrimaryController;

    /**
     * @var bool $isSigner Whether the person signs the business's boarding applications.
     */
    #[JsonProperty('isSigner')]
    public bool $isSigner;

    /**
     * @var ?string $title The person's job title at this business.
     */
    #[JsonProperty('title')]
    public ?string $title;

    /**
     * @var ?string $primaryEmail The relationship's primary email address.
     */
    #[JsonProperty('primaryEmail')]
    public ?string $primaryEmail;

    /**
     * @var ?string $secondaryEmail The relationship's secondary email address.
     */
    #[JsonProperty('secondaryEmail')]
    public ?string $secondaryEmail;

    /**
     * @var ?string $primaryPhoneNumber The relationship's primary phone number.
     */
    #[JsonProperty('primaryPhoneNumber')]
    public ?string $primaryPhoneNumber;

    /**
     * @var ?string $secondaryPhoneNumber The relationship's secondary phone number.
     */
    #[JsonProperty('secondaryPhoneNumber')]
    public ?string $secondaryPhoneNumber;

    /**
     * @var ?string $billingAddressUuid Reference to the stored billing address for the relationship. Present when a billing address was set.
     */
    #[JsonProperty('billingAddressUuid')]
    public ?string $billingAddressUuid;

    /**
     * @var ?string $mailingAddressUuid Reference to the stored mailing address for the relationship. Present when a mailing address was set.
     */
    #[JsonProperty('mailingAddressUuid')]
    public ?string $mailingAddressUuid;

    /**
     * @var DateTime $createdAt When the link was created.
     */
    #[JsonProperty('createdAt'), Date(Date::TYPE_DATETIME)]
    public DateTime $createdAt;

    /**
     * @var DateTime $updatedAt When the link was last updated.
     */
    #[JsonProperty('updatedAt'), Date(Date::TYPE_DATETIME)]
    public DateTime $updatedAt;

    /**
     * @var BusinessPersonLinks $links Hypermedia links for the link resource.
     */
    #[JsonProperty('_links')]
    public BusinessPersonLinks $links;

    /**
     * @param array{
     *   businessReference: string,
     *   personReference: string,
     *   personType: string,
     *   beneficialOwner: bool,
     *   isPrimaryController: bool,
     *   isSigner: bool,
     *   createdAt: DateTime,
     *   updatedAt: DateTime,
     *   links: BusinessPersonLinks,
     *   ownershipPercentage?: ?float,
     *   title?: ?string,
     *   primaryEmail?: ?string,
     *   secondaryEmail?: ?string,
     *   primaryPhoneNumber?: ?string,
     *   secondaryPhoneNumber?: ?string,
     *   billingAddressUuid?: ?string,
     *   mailingAddressUuid?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->businessReference = $values['businessReference'];
        $this->personReference = $values['personReference'];
        $this->personType = $values['personType'];
        $this->ownershipPercentage = $values['ownershipPercentage'] ?? null;
        $this->beneficialOwner = $values['beneficialOwner'];
        $this->isPrimaryController = $values['isPrimaryController'];
        $this->isSigner = $values['isSigner'];
        $this->title = $values['title'] ?? null;
        $this->primaryEmail = $values['primaryEmail'] ?? null;
        $this->secondaryEmail = $values['secondaryEmail'] ?? null;
        $this->primaryPhoneNumber = $values['primaryPhoneNumber'] ?? null;
        $this->secondaryPhoneNumber = $values['secondaryPhoneNumber'] ?? null;
        $this->billingAddressUuid = $values['billingAddressUuid'] ?? null;
        $this->mailingAddressUuid = $values['mailingAddressUuid'] ?? null;
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
