<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Core\Types\ArrayType;
use DateTime;
use Payabli\Core\Types\Date;

/**
 * The full detail of a person. Sensitive fields are masked unless read from the unmasked endpoint.
 */
class PersonDetailResponse extends JsonSerializableType
{
    /**
     * @var string $personReference The person reference.
     */
    #[JsonProperty('personReference')]
    public string $personReference;

    /**
     * @var ?string $externalId Your own identifier for the person.
     */
    #[JsonProperty('externalId')]
    public ?string $externalId;

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
     * @var ?string $dateOfBirth The person's date of birth. Masked on standard reads (for example `****-**-14`); read the unmasked endpoint for the raw value.
     */
    #[JsonProperty('dateOfBirth')]
    public ?string $dateOfBirth;

    /**
     * @var ?string $ssn The person's US Social Security Number. Populated when `nationality` is `US`, otherwise null. Masked on standard reads (for example `***-**-9021`); read the unmasked endpoint for the raw value.
     */
    #[JsonProperty('ssn')]
    public ?string $ssn;

    /**
     * @var ?string $nationality The person's nationality, as a two-letter ISO 3166-1 alpha-2 country code. Not masked. When `US`, `ssn` is populated and the national ID fields are null; for any other value, `nationalIdNumber` and `nationalIdIssuer` are populated and `ssn` is null.
     */
    #[JsonProperty('nationality')]
    public ?string $nationality;

    /**
     * @var ?string $nationalIdNumber The person's national identification number. Populated when `nationality` is not `US`, otherwise null. Masked on standard reads; read the unmasked endpoint for the raw value.
     */
    #[JsonProperty('nationalIdNumber')]
    public ?string $nationalIdNumber;

    /**
     * @var ?string $nationalIdIssuer The authority that issued the national ID, for example the two-letter country code. Populated when `nationality` is not `US`, otherwise null.
     */
    #[JsonProperty('nationalIdIssuer')]
    public ?string $nationalIdIssuer;

    /**
     * @var ?string $driversLicenseNumber The person's driver's license number. Masked on standard reads (for example `D1***567`); read the unmasked endpoint for the raw value.
     */
    #[JsonProperty('driversLicenseNumber')]
    public ?string $driversLicenseNumber;

    /**
     * @var ?string $driversLicenseState The two-letter state code for the driver's license.
     */
    #[JsonProperty('driversLicenseState')]
    public ?string $driversLicenseState;

    /**
     * Arbitrary key-value data attached to the person. When present,
     * `templateAnswers` holds this owner's answers to a boarding
     * template's person-scoped custom questions, meaning questions
     * whose field path starts with `person.`, such as
     * `person.backgroundCheck`. Payabli saves them on each owner. It's
     * an object keyed by field path, and each answer is a string. A
     * multi-select answer is one comma-separated string.
     *
     * Payabli saves the answers when an application is submitted
     * through the hosted boarding application. Submitting an
     * application with the API
     * (`POST /v2/requests/{requestsReference}/submit`) doesn't save them.
     * Only answers to custom questions are saved, and blank answers,
     * standard-field answers, and document uploads aren't. A later
     * hosted submit replaces the answer to the same question and keeps
     * every other answer, including answers from other applications.
     * Leaving a question blank on a later submit doesn't remove the
     * stored answer.
     *
     * @var ?array<string, mixed> $customData
     */
    #[JsonProperty('customData'), ArrayType(['string' => 'mixed'])]
    public ?array $customData;

    /**
     * @var string $verificationStatus The person's identity verification status, for example `not_started`.
     */
    #[JsonProperty('verificationStatus')]
    public string $verificationStatus;

    /**
     * @var ?array<PersonAddressResponse> $addresses Postal addresses associated with the person.
     */
    #[JsonProperty('addresses'), ArrayType([PersonAddressResponse::class])]
    public ?array $addresses;

    /**
     * @var ?array<IdentificationDocumentResponse> $identificationDocuments Government-issued identification documents for the person.
     */
    #[JsonProperty('identificationDocuments'), ArrayType([IdentificationDocumentResponse::class])]
    public ?array $identificationDocuments;

    /**
     * The business link created with the person, present when the person was
     * created with a `businessRelationship`. Null on a standalone person read,
     * since the relationship is scoped to the business rather than the shared
     * person.
     *
     * @var ?BusinessRelationshipResponse $businessRelationship
     */
    #[JsonProperty('businessRelationship')]
    public ?BusinessRelationshipResponse $businessRelationship;

    /**
     * @var DateTime $createdAt When the person was created.
     */
    #[JsonProperty('createdAt'), Date(Date::TYPE_DATETIME)]
    public DateTime $createdAt;

    /**
     * @var DateTime $lastUpdated When the person was last updated.
     */
    #[JsonProperty('lastUpdated'), Date(Date::TYPE_DATETIME)]
    public DateTime $lastUpdated;

    /**
     * @var PersonLinks $links Hypermedia links for the person resource.
     */
    #[JsonProperty('_links')]
    public PersonLinks $links;

    /**
     * @param array{
     *   personReference: string,
     *   verificationStatus: string,
     *   createdAt: DateTime,
     *   lastUpdated: DateTime,
     *   links: PersonLinks,
     *   externalId?: ?string,
     *   firstName?: ?string,
     *   middleName?: ?string,
     *   lastName?: ?string,
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
     *   customData?: ?array<string, mixed>,
     *   addresses?: ?array<PersonAddressResponse>,
     *   identificationDocuments?: ?array<IdentificationDocumentResponse>,
     *   businessRelationship?: ?BusinessRelationshipResponse,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->personReference = $values['personReference'];
        $this->externalId = $values['externalId'] ?? null;
        $this->firstName = $values['firstName'] ?? null;
        $this->middleName = $values['middleName'] ?? null;
        $this->lastName = $values['lastName'] ?? null;
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
        $this->customData = $values['customData'] ?? null;
        $this->verificationStatus = $values['verificationStatus'];
        $this->addresses = $values['addresses'] ?? null;
        $this->identificationDocuments = $values['identificationDocuments'] ?? null;
        $this->businessRelationship = $values['businessRelationship'] ?? null;
        $this->createdAt = $values['createdAt'];
        $this->lastUpdated = $values['lastUpdated'];
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
