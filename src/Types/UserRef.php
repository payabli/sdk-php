<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * A reference to a user, with the display name resolved when available.
 */
class UserRef extends JsonSerializableType
{
    /**
     * @var int $id The user's numeric identifier.
     */
    #[JsonProperty('id')]
    public int $id;

    /**
     * @var ?string $name The user's display name. Null when the name can't be resolved.
     */
    #[JsonProperty('name')]
    public ?string $name;

    /**
     * @param array{
     *   id: int,
     *   name?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->id = $values['id'];
        $this->name = $values['name'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
