<?php

namespace Payabli\People\Requests;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Core\Types\ArrayType;
use Payabli\Types\PersonAddressRequest;
use Payabli\Types\IdentificationDocumentRequest;
use Payabli\Types\BusinessRelationshipRequest;

class CreatePersonRequest extends JsonSerializableType
{
    /**
     * @var string $firstName The person's first name.
     */
    #[JsonProperty('firstName')]
    public string $firstName;

    /**
     * @var ?string $middleName The person's middle name.
     */
    #[JsonProperty('middleName')]
    public ?string $middleName;

    /**
     * @var string $lastName The person's last name.
     */
    #[JsonProperty('lastName')]
    public string $lastName;

    /**
     * @var ?string $primaryEmail The person's primary email address.
     */
    #[JsonProperty('primaryEmail')]
    public ?string $primaryEmail;

    /**
     * @var ?string $secondaryEmail The person's secondary email address.
     */
    #[JsonProperty('secondaryEmail')]
    public ?string $secondaryEmail;

    /**
     * @var ?string $primaryPhoneNumber The person's primary phone number.
     */
    #[JsonProperty('primaryPhoneNumber')]
    public ?string $primaryPhoneNumber;

    /**
     * @var ?string $secondaryPhoneNumber The person's secondary phone number.
     */
    #[JsonProperty('secondaryPhoneNumber')]
    public ?string $secondaryPhoneNumber;

    /**
     * @var ?string $dateOfBirth The person's date of birth (`YYYY-MM-DD`).
     */
    #[JsonProperty('dateOfBirth')]
    public ?string $dateOfBirth;

    /**
     * @var ?string $ssn The person's US Social Security Number, in `XXX-XX-XXXX` or `XXXXXXXXX` format. Applies when `nationality` is `US`, and needed to validate a US owner. Create doesn't enforce it. For any other nationality, send `nationalIdNumber` and `nationalIdIssuer` instead.
     */
    #[JsonProperty('ssn')]
    public ?string $ssn;

    /**
     * @var ?string $nationality The person's nationality, as a two-letter ISO 3166-1 alpha-2 country code. Needed to validate an owner, but create doesn't enforce it. Nationality selects which identity number applies. `US` uses `ssn`, and any other value uses `nationalIdNumber` and `nationalIdIssuer`.
     */
    #[JsonProperty('nationality')]
    public ?string $nationality;

    /**
     * @var ?string $nationalIdNumber The person's national identification number, for an individual whose `nationality` is not `US`. Send it with `nationalIdIssuer` when `nationality` is non-US. Create doesn't enforce it.
     */
    #[JsonProperty('nationalIdNumber')]
    public ?string $nationalIdNumber;

    /**
     * @var ?string $nationalIdIssuer The authority that issued the national ID, for example the two-letter country code. Send it with `nationalIdNumber` when `nationality` is non-US. Create doesn't enforce it.
     */
    #[JsonProperty('nationalIdIssuer')]
    public ?string $nationalIdIssuer;

    /**
     * @var ?string $driversLicenseNumber The person's driver's license number.
     */
    #[JsonProperty('driversLicenseNumber')]
    public ?string $driversLicenseNumber;

    /**
     * @var ?string $driversLicenseState The two-letter state code for the driver's license.
     */
    #[JsonProperty('driversLicenseState')]
    public ?string $driversLicenseState;

    /**
     * @var ?string $externalId Your own identifier for the person.
     */
    #[JsonProperty('externalId')]
    public ?string $externalId;

    /**
     * Arbitrary key-value data you attach to the person. Payabli
     * stores an owner's answers to a boarding template's custom
     * questions under the `templateAnswers` key.
     *
     * @var ?array<string, mixed> $customData
     */
    #[JsonProperty('customData'), ArrayType(['string' => 'mixed'])]
    public ?array $customData;

    /**
     * @var ?array<PersonAddressRequest> $addresses Postal addresses associated with the person.
     */
    #[JsonProperty('addresses'), ArrayType([PersonAddressRequest::class])]
    public ?array $addresses;

    /**
     * @var ?array<IdentificationDocumentRequest> $identificationDocuments Government-issued identification documents for the person.
     */
    #[JsonProperty('identificationDocuments'), ArrayType([IdentificationDocumentRequest::class])]
    public ?array $identificationDocuments;

    /**
     * Links the person to a business as you create them. The link's role,
     * ownership, primary-controller flag, contact fields, and addresses go here.
     * These relationship contact fields are separate from the person's own
     * top-level contact fields above.
     *
     * @var ?BusinessRelationshipRequest $businessRelationship
     */
    #[JsonProperty('businessRelationship')]
    public ?BusinessRelationshipRequest $businessRelationship;

    /**
     * @param array{
     *   firstName: string,
     *   lastName: string,
     *   middleName?: ?string,
     *   primaryEmail?: ?string,
     *   secondaryEmail?: ?string,
     *   primaryPhoneNumber?: ?string,
     *   secondaryPhoneNumber?: ?string,
     *   dateOfBirth?: ?string,
     *   ssn?: ?string,
     *   nationality?: ?string,
     *   nationalIdNumber?: ?string,
     *   nationalIdIssuer?: ?string,
     *   driversLicenseNumber?: ?string,
     *   driversLicenseState?: ?string,
     *   externalId?: ?string,
     *   customData?: ?array<string, mixed>,
     *   addresses?: ?array<PersonAddressRequest>,
     *   identificationDocuments?: ?array<IdentificationDocumentRequest>,
     *   businessRelationship?: ?BusinessRelationshipRequest,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->firstName = $values['firstName'];
        $this->middleName = $values['middleName'] ?? null;
        $this->lastName = $values['lastName'];
        $this->primaryEmail = $values['primaryEmail'] ?? null;
        $this->secondaryEmail = $values['secondaryEmail'] ?? null;
        $this->primaryPhoneNumber = $values['primaryPhoneNumber'] ?? null;
        $this->secondaryPhoneNumber = $values['secondaryPhoneNumber'] ?? null;
        $this->dateOfBirth = $values['dateOfBirth'] ?? null;
        $this->ssn = $values['ssn'] ?? null;
        $this->nationality = $values['nationality'] ?? null;
        $this->nationalIdNumber = $values['nationalIdNumber'] ?? null;
        $this->nationalIdIssuer = $values['nationalIdIssuer'] ?? null;
        $this->driversLicenseNumber = $values['driversLicenseNumber'] ?? null;
        $this->driversLicenseState = $values['driversLicenseState'] ?? null;
        $this->externalId = $values['externalId'] ?? null;
        $this->customData = $values['customData'] ?? null;
        $this->addresses = $values['addresses'] ?? null;
        $this->identificationDocuments = $values['identificationDocuments'] ?? null;
        $this->businessRelationship = $values['businessRelationship'] ?? null;
    }
}
