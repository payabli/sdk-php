<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Core\Types\ArrayType;

/**
 * The result of validating a bank account change before creating a case.
 */
class PreCreationValidationResult extends JsonSerializableType
{
    /**
     * @var bool $isValid Whether the request can be created. False when there are blocking conditions.
     */
    #[JsonProperty('isValid')]
    public bool $isValid;

    /**
     * @var array<string> $blockingConditions Conditions that prevent creation. Must be resolved first.
     */
    #[JsonProperty('blockingConditions'), ArrayType(['string'])]
    public array $blockingConditions;

    /**
     * @var array<string> $warnings Informational warnings. Creation can still proceed.
     */
    #[JsonProperty('warnings'), ArrayType(['string'])]
    public array $warnings;

    /**
     * @var array<string> $validationErrors Field-level validation errors.
     */
    #[JsonProperty('validationErrors'), ArrayType(['string'])]
    public array $validationErrors;

    /**
     * @param array{
     *   isValid: bool,
     *   blockingConditions: array<string>,
     *   warnings: array<string>,
     *   validationErrors: array<string>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->isValid = $values['isValid'];
        $this->blockingConditions = $values['blockingConditions'];
        $this->warnings = $values['warnings'];
        $this->validationErrors = $values['validationErrors'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
