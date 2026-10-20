<?php

namespace Payabli\Businesses\Requests;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Types\PersonType;
use Payabli\Types\PersonAddressRequest;

class LinkBusinessPersonRequest extends JsonSerializableType
{
    /**
     * @var string $personReference The reference of the person to link.
     */
    #[JsonProperty('personReference')]
    public string $personReference;

    /**
     * @var ?value-of<PersonType> $personType The person's role on the business.
     */
    #[JsonProperty('personType')]
    public ?string $personType;

    /**
     * @var ?float $ownershipPercentage The person's ownership percentage (0 to 100). Required when `personType` is `Owner`, and must be omitted for every other role. If the combined ownership would exceed 100%, the link is rejected with a `400`.
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
     *   personReference: string,
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
        $this->personReference = $values['personReference'];
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
}
