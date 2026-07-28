<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * A reference to the paypoint the case applies to.
 */
class PaypointRef extends JsonSerializableType
{
    /**
     * @var int $id The paypoint's numeric identifier.
     */
    #[JsonProperty('id')]
    public int $id;

    /**
     * @var string $name The paypoint's DBA name.
     */
    #[JsonProperty('name')]
    public string $name;

    /**
     * @param array{
     *   id: int,
     *   name: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->id = $values['id'];
        $this->name = $values['name'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
