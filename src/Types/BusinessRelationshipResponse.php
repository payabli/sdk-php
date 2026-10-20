<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * The business-person relationship returned when a person is created with a
 * `businessRelationship`. Its contact fields are scoped to the relationship and
 * are distinct from the person's own top-level contact fields.
 */
class BusinessRelationshipResponse extends JsonSerializableType
{
    /**
     * @var string $businessReference The reference of the linked business.
     */
    #[JsonProperty('businessReference')]
    public string $businessReference;

    /**
     * @var string $personType The person's role on the business, returned in lowercase (for example `owner`).
     */
    #[JsonProperty('personType')]
    public string $personType;

    /**
     * @var ?float $ownershipPercentage The person's ownership percentage (0 to 100).
     */
    #[JsonProperty('ownershipPercentage')]
    public ?float $ownershipPercentage;

    /**
     * @var bool $beneficialOwner Whether the person qualifies as a beneficial owner. Derived by Payabli, not sent on create.
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
     * Reference to the stored billing address for the relationship. The address
     * is sent as an object on create, then stored and returned by ID.
     *
     * @var ?string $billingAddressUuid
     */
    #[JsonProperty('billingAddressUuid')]
    public ?string $billingAddressUuid;

    /**
     * Reference to the stored mailing address for the relationship. The address
     * is sent as an object on create, then stored and returned by ID.
     *
     * @var ?string $mailingAddressUuid
     */
    #[JsonProperty('mailingAddressUuid')]
    public ?string $mailingAddressUuid;

    /**
     * @param array{
     *   businessReference: string,
     *   personType: string,
     *   beneficialOwner: bool,
     *   isPrimaryController: bool,
     *   isSigner: bool,
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
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
