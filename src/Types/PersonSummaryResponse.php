<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use DateTime;
use Payabli\Core\Types\Date;

/**
 * A person as it appears in a list response.
 */
class PersonSummaryResponse extends JsonSerializableType
{
    /**
     * @var PersonLinks $links Hypermedia links for the person resource.
     */
    #[JsonProperty('_links')]
    public PersonLinks $links;

    /**
     * @var string $personReference The person reference, used to read and manage the person.
     */
    #[JsonProperty('personReference')]
    public string $personReference;

    /**
     * @var ?string $firstName The person's first name.
     */
    #[JsonProperty('firstName')]
    public ?string $firstName;

    /**
     * @var ?string $lastName The person's last name.
     */
    #[JsonProperty('lastName')]
    public ?string $lastName;

    /**
     * @var ?string $email The person's primary email address.
     */
    #[JsonProperty('email')]
    public ?string $email;

    /**
     * @var string $verificationStatus The person's identity verification status, for example `notstarted`.
     */
    #[JsonProperty('verificationStatus')]
    public string $verificationStatus;

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
     * @param array{
     *   links: PersonLinks,
     *   personReference: string,
     *   verificationStatus: string,
     *   createdAt: DateTime,
     *   lastUpdated: DateTime,
     *   firstName?: ?string,
     *   lastName?: ?string,
     *   email?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->links = $values['links'];
        $this->personReference = $values['personReference'];
        $this->firstName = $values['firstName'] ?? null;
        $this->lastName = $values['lastName'] ?? null;
        $this->email = $values['email'] ?? null;
        $this->verificationStatus = $values['verificationStatus'];
        $this->createdAt = $values['createdAt'];
        $this->lastUpdated = $values['lastUpdated'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
