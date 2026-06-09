<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * Object with detailed error context.
 */
class PayabliErrorBodyResponseData extends JsonSerializableType
{
    /**
     * @var ?string $explanation Human-readable explanation of what happened.
     */
    #[JsonProperty('explanation')]
    public ?string $explanation;

    /**
     * @var ?string $todoAction Suggested resolution.
     */
    #[JsonProperty('todoAction')]
    public ?string $todoAction;

    /**
     * @param array{
     *   explanation?: ?string,
     *   todoAction?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->explanation = $values['explanation'] ?? null;
        $this->todoAction = $values['todoAction'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
