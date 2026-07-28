<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * A single bank-verification result code returned by the verification provider.
 */
class VerificationCode extends JsonSerializableType
{
    /**
     * @var int $code The numeric result code.
     */
    #[JsonProperty('code')]
    public int $code;

    /**
     * @var ?string $name The short code name.
     */
    #[JsonProperty('name')]
    public ?string $name;

    /**
     * @var ?string $description A human-readable description of the result.
     */
    #[JsonProperty('description')]
    public ?string $description;

    /**
     * @param array{
     *   code: int,
     *   name?: ?string,
     *   description?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->code = $values['code'];
        $this->name = $values['name'] ?? null;
        $this->description = $values['description'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
