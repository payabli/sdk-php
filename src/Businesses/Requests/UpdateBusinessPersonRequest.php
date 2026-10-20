<?php

namespace Payabli\Businesses\Requests;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Types\PersonType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Types\PersonAddressRequest;

class UpdateBusinessPersonRequest extends JsonSerializableType
{
    /**
     * @var ?value-of<PersonType> $personType The person's role on the business.
     */
    #[JsonProperty('personType')]
    public ?string $personType;

    /**
     * @var ?float $ownershipPercentage The person's ownership percentage (0 to 100).
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
     * `Only an owner can be the signer.` Changing the signer's `personType`
     * away from `Owner` returns the same error. Setting it to `true` removes
     * it from every other person linked to the business. Setting it to
     * `false` leaves the business with no signer until you set another one.
     *
     * @var ?bool $isSigner
     */
    #[JsonProperty('isSigner')]
    public ?bool $isSigner;

    /**
     * The person's job title at this business, from 1 to 100 characters. Updating it changes the title
     * for this business only. Omitting it, or sending `null` or a blank value,
     * keeps the stored title. You can replace a title, but you can't clear it.
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
        array $values = [],
    ) {
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
