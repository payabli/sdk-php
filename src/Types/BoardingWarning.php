<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * A non-blocking warning returned alongside a successful response.
 */
class BoardingWarning extends JsonSerializableType
{
    /**
     * @var ?string $code A machine-readable warning code.
     */
    #[JsonProperty('code')]
    public ?string $code;

    /**
     * @var ?string $message A human-readable description of the warning.
     */
    #[JsonProperty('message')]
    public ?string $message;

    /**
     * @param array{
     *   code?: ?string,
     *   message?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->code = $values['code'] ?? null;
        $this->message = $values['message'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
