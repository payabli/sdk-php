<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Core\Types\ArrayType;

/**
 * The transition actions currently available on a case. Empty when no user action is available.
 */
class AvailableTransitionsResponse extends JsonSerializableType
{
    /**
     * @var array<value-of<CaseTrigger>> $transitions The available transition actions.
     */
    #[JsonProperty('transitions'), ArrayType(['string'])]
    public array $transitions;

    /**
     * @param array{
     *   transitions: array<value-of<CaseTrigger>>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->transitions = $values['transitions'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
