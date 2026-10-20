<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Core\Types\ArrayType;

/**
 * A single identity match returned by a search.
 */
class PeopleSearchResultResponse extends JsonSerializableType
{
    /**
     * @var ?string $personReference The person reference of the matching existing person. Null when `isFromVendor` is `true`.
     */
    #[JsonProperty('personReference')]
    public ?string $personReference;

    /**
     * @var ?string $firstName The matched first name.
     */
    #[JsonProperty('firstName')]
    public ?string $firstName;

    /**
     * @var ?string $lastName The matched last name.
     */
    #[JsonProperty('lastName')]
    public ?string $lastName;

    /**
     * @var ?string $dateOfBirth The matched date of birth. The standard search masks it (for example `****-**-14`), and the unmasked search returns the full `YYYY-MM-DD` value.
     */
    #[JsonProperty('dateOfBirth')]
    public ?string $dateOfBirth;

    /**
     * @var ?string $primaryEmail The matched primary email address.
     */
    #[JsonProperty('primaryEmail')]
    public ?string $primaryEmail;

    /**
     * @var ?string $primaryPhone The matched primary phone number.
     */
    #[JsonProperty('primaryPhone')]
    public ?string $primaryPhone;

    /**
     * @var ?string $riskDecision The risk decision for the match.
     */
    #[JsonProperty('riskDecision')]
    public ?string $riskDecision;

    /**
     * @var ?float $matchScore How closely the record matches the search criteria.
     */
    #[JsonProperty('matchScore')]
    public ?float $matchScore;

    /**
     * @var ?bool $isTopMatch Whether this is the highest-scoring match.
     */
    #[JsonProperty('isTopMatch')]
    public ?bool $isTopMatch;

    /**
     * @var ?bool $isFromVendor When `true`, no existing person matched, and this result comes only from the identity vendor. A vendor result has no `personReference`.
     */
    #[JsonProperty('isFromVendor')]
    public ?bool $isFromVendor;

    /**
     * @var ?array<string> $phones The person's phone numbers.
     */
    #[JsonProperty('phones'), ArrayType(['string'])]
    public ?array $phones;

    /**
     * @var ?array<string> $emails The person's email addresses.
     */
    #[JsonProperty('emails'), ArrayType(['string'])]
    public ?array $emails;

    /**
     * @var ?int $addressCount The number of addresses on file for the person.
     */
    #[JsonProperty('addressCount')]
    public ?int $addressCount;

    /**
     * @var ?int $phoneCount The number of phone numbers on file for the person.
     */
    #[JsonProperty('phoneCount')]
    public ?int $phoneCount;

    /**
     * @var ?int $emailCount The number of email addresses on file for the person.
     */
    #[JsonProperty('emailCount')]
    public ?int $emailCount;

    /**
     * @param array{
     *   personReference?: ?string,
     *   firstName?: ?string,
     *   lastName?: ?string,
     *   dateOfBirth?: ?string,
     *   primaryEmail?: ?string,
     *   primaryPhone?: ?string,
     *   riskDecision?: ?string,
     *   matchScore?: ?float,
     *   isTopMatch?: ?bool,
     *   isFromVendor?: ?bool,
     *   phones?: ?array<string>,
     *   emails?: ?array<string>,
     *   addressCount?: ?int,
     *   phoneCount?: ?int,
     *   emailCount?: ?int,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->personReference = $values['personReference'] ?? null;
        $this->firstName = $values['firstName'] ?? null;
        $this->lastName = $values['lastName'] ?? null;
        $this->dateOfBirth = $values['dateOfBirth'] ?? null;
        $this->primaryEmail = $values['primaryEmail'] ?? null;
        $this->primaryPhone = $values['primaryPhone'] ?? null;
        $this->riskDecision = $values['riskDecision'] ?? null;
        $this->matchScore = $values['matchScore'] ?? null;
        $this->isTopMatch = $values['isTopMatch'] ?? null;
        $this->isFromVendor = $values['isFromVendor'] ?? null;
        $this->phones = $values['phones'] ?? null;
        $this->emails = $values['emails'] ?? null;
        $this->addressCount = $values['addressCount'] ?? null;
        $this->phoneCount = $values['phoneCount'] ?? null;
        $this->emailCount = $values['emailCount'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
