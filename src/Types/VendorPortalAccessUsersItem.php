<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

class VendorPortalAccessUsersItem extends JsonSerializableType
{
    /**
     * @var ?int $userId The user's ID.
     */
    #[JsonProperty('UserId')]
    public ?int $userId;

    /**
     * @var ?string $email The user's email address.
     */
    #[JsonProperty('Email')]
    public ?string $email;

    /**
     * @var ?string $name The user's name.
     */
    #[JsonProperty('Name')]
    public ?string $name;

    /**
     * @var ?string $phone The user's phone number.
     */
    #[JsonProperty('Phone')]
    public ?string $phone;

    /**
     * @param array{
     *   userId?: ?int,
     *   email?: ?string,
     *   name?: ?string,
     *   phone?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->userId = $values['userId'] ?? null;
        $this->email = $values['email'] ?? null;
        $this->name = $values['name'] ?? null;
        $this->phone = $values['phone'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
