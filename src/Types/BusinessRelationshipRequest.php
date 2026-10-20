<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * Links the person to a business as part of a person-create request. The
 * contact fields here are scoped to the business-person relationship and are
 * distinct from the person's own top-level `primaryEmail`, `primaryPhoneNumber`,
 * and so on.
 */
class BusinessRelationshipRequest extends JsonSerializableType
{
    /**
     * @var string $businessReference The reference of the business to link the person to.
     */
    #[JsonProperty('businessReference')]
    public string $businessReference;

    /**
     * @var ?value-of<PersonType> $personType The person's role on the business.
     */
    #[JsonProperty('personType')]
    public ?string $personType;

    /**
     * The person's ownership percentage (0 to 100). Required when `personType`
     * is `Owner`, and must be omitted for every other role. If linking the
     * owner would push the business over 100% total ownership, the person is
     * still created but the link doesn't complete. The response has `success`
     * set to `false`, omits `businessRelationship` from the person, and
     * returns a `LINK_OWNERSHIP_EXCEEDED` entry in `warnings`.
     *
     * @var ?float $ownershipPercentage
     */
    #[JsonProperty('ownershipPercentage')]
    public ?float $ownershipPercentage;

    /**
     * @var ?bool $isPrimaryController Whether the person is the business's primary controller.
     */
    #[JsonProperty('isPrimaryController')]
    public ?bool $isPrimaryController;

    /**
     * Whether the person signs the business's boarding applications. Only an
     * owner can be the signer. Setting `isSigner` to `true` on a person with
     * another `personType` returns `400` with the message
     * `Only an owner can be the signer.` A business has one signer. Setting
     * `isSigner` to `true` on one person removes it from every other person
     * linked to the business.
     *
     * @var ?bool $isSigner
     */
    #[JsonProperty('isSigner')]
    public ?bool $isSigner;

    /**
     * The person's job title at this business, such as `CEO` or
     * `Managing Member`, from 1 to 100 characters. A person linked to more than
     * one business can have a different title at each one. A blank value is
     * treated as not sent.
     *
     * @var ?string $title
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
     * @var ?PersonAddressRequest $billingAddress The billing address for the relationship.
     */
    #[JsonProperty('billingAddress')]
    public ?PersonAddressRequest $billingAddress;

    /**
     * @var ?PersonAddressRequest $mailingAddress The mailing address for the relationship.
     */
    #[JsonProperty('mailingAddress')]
    public ?PersonAddressRequest $mailingAddress;

    /**
     * @param array{
     *   businessReference: string,
     *   personType?: ?value-of<PersonType>,
     *   ownershipPercentage?: ?float,
     *   isPrimaryController?: ?bool,
     *   isSigner?: ?bool,
     *   title?: ?string,
     *   primaryEmail?: ?string,
     *   secondaryEmail?: ?string,
     *   primaryPhoneNumber?: ?string,
     *   secondaryPhoneNumber?: ?string,
     *   billingAddress?: ?PersonAddressRequest,
     *   mailingAddress?: ?PersonAddressRequest,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->businessReference = $values['businessReference'];
        $this->personType = $values['personType'] ?? null;
        $this->ownershipPercentage = $values['ownershipPercentage'] ?? null;
        $this->isPrimaryController = $values['isPrimaryController'] ?? null;
        $this->isSigner = $values['isSigner'] ?? null;
        $this->title = $values['title'] ?? null;
        $this->primaryEmail = $values['primaryEmail'] ?? null;
        $this->secondaryEmail = $values['secondaryEmail'] ?? null;
        $this->primaryPhoneNumber = $values['primaryPhoneNumber'] ?? null;
        $this->secondaryPhoneNumber = $values['secondaryPhoneNumber'] ?? null;
        $this->billingAddress = $values['billingAddress'] ?? null;
        $this->mailingAddress = $values['mailingAddress'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
