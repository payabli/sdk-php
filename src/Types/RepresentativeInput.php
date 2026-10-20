<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * A sales or service representative assigned to the application.
 */
class RepresentativeInput extends JsonSerializableType
{
    /**
     * @var ?string $userId The representative's user identifier.
     */
    #[JsonProperty('userId')]
    public ?string $userId;

    /**
     * @var ?int $repCode The representative's code.
     */
    #[JsonProperty('repCode')]
    public ?int $repCode;

    /**
     * @var ?string $firstName The representative's first name.
     */
    #[JsonProperty('firstName')]
    public ?string $firstName;

    /**
     * @var ?string $lastName The representative's last name.
     */
    #[JsonProperty('lastName')]
    public ?string $lastName;

    /**
     * @var ?string $location The representative's location.
     */
    #[JsonProperty('location')]
    public ?string $location;

    /**
     * @var ?string $team The representative's team.
     */
    #[JsonProperty('team')]
    public ?string $team;

    /**
     * @param array{
     *   userId?: ?string,
     *   repCode?: ?int,
     *   firstName?: ?string,
     *   lastName?: ?string,
     *   location?: ?string,
     *   team?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->userId = $values['userId'] ?? null;
        $this->repCode = $values['repCode'] ?? null;
        $this->firstName = $values['firstName'] ?? null;
        $this->lastName = $values['lastName'] ?? null;
        $this->location = $values['location'] ?? null;
        $this->team = $values['team'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
