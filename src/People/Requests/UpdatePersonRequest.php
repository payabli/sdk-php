<?php

namespace Payabli\People\Requests;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Core\Types\ArrayType;
use Payabli\Types\PersonAddressRequest;
use Payabli\Types\IdentificationDocumentRequest;

class UpdatePersonRequest extends JsonSerializableType
{
    /**
     * @var ?string $firstName The person's first name.
     */
    #[JsonProperty('firstName')]
    public ?string $firstName;

    /**
     * @var ?string $middleName The person's middle name.
     */
    #[JsonProperty('middleName')]
    public ?string $middleName;

    /**
     * @var ?string $lastName The person's last name.
     */
    #[JsonProperty('lastName')]
    public ?string $lastName;

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
     * @var ?string $nationality The person's nationality, as a two-letter ISO 3166-1 alpha-2 country code. Nationality selects which identity number applies — `US` uses `ssn`, and any other value uses `nationalIdNumber` and `nationalIdIssuer`.
     */
    #[JsonProperty('nationality')]
    public ?string $nationality;

    /**
     * @var ?string $nationalIdIssuer The authority that issued the national ID, used when `nationality` is not `US`.
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
     * Key-value data to merge into the person's stored `customData`.
     * Payabli stores an owner's answers to a boarding template's
     * custom questions under the `templateAnswers` key.
     *
     * When you update a person, Payabli merges `customData` into the
     * stored value, following JSON Merge Patch (RFC 7396). Keys you
     * don't send are kept at every depth, and nested objects merge key
     * by key. Strings, numbers, Boolean values, and arrays replace the
     * stored value, and arrays aren't merged. Send a key as `null` to
     * delete it, such as `{"crmId": null}`. A `customData` that isn't
     * an object, such as an array, replaces the stored value whole.
     * Leave out `customData` to keep it as is.
     *
     * The `customData` you send can be up to 65,536 bytes serialized.
     * The limit applies to the request, not to the merged result.
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
     * @param array{
     *   firstName?: ?string,
     *   middleName?: ?string,
     *   lastName?: ?string,
     *   primaryEmail?: ?string,
     *   secondaryEmail?: ?string,
     *   primaryPhoneNumber?: ?string,
     *   secondaryPhoneNumber?: ?string,
     *   nationality?: ?string,
     *   nationalIdIssuer?: ?string,
     *   driversLicenseNumber?: ?string,
     *   driversLicenseState?: ?string,
     *   externalId?: ?string,
     *   customData?: ?array<string, mixed>,
     *   addresses?: ?array<PersonAddressRequest>,
     *   identificationDocuments?: ?array<IdentificationDocumentRequest>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->firstName = $values['firstName'] ?? null;
        $this->middleName = $values['middleName'] ?? null;
        $this->lastName = $values['lastName'] ?? null;
        $this->primaryEmail = $values['primaryEmail'] ?? null;
        $this->secondaryEmail = $values['secondaryEmail'] ?? null;
        $this->primaryPhoneNumber = $values['primaryPhoneNumber'] ?? null;
        $this->secondaryPhoneNumber = $values['secondaryPhoneNumber'] ?? null;
        $this->nationality = $values['nationality'] ?? null;
        $this->nationalIdIssuer = $values['nationalIdIssuer'] ?? null;
        $this->driversLicenseNumber = $values['driversLicenseNumber'] ?? null;
        $this->driversLicenseState = $values['driversLicenseState'] ?? null;
        $this->externalId = $values['externalId'] ?? null;
        $this->customData = $values['customData'] ?? null;
        $this->addresses = $values['addresses'] ?? null;
        $this->identificationDocuments = $values['identificationDocuments'] ?? null;
    }
}
