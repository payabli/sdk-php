<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Core\Types\ArrayType;

/**
 * The validation result for one section of the application.
 */
class ValidationSection extends JsonSerializableType
{
    /**
     * @var bool $complete Whether the section has no missing or invalid fields.
     */
    #[JsonProperty('complete')]
    public bool $complete;

    /**
     * @var array<ValidationMissingField> $missingFields The fields that are missing or invalid in this section. Empty when the section is complete.
     */
    #[JsonProperty('missingFields'), ArrayType([ValidationMissingField::class])]
    public array $missingFields;

    /**
     * @param array{
     *   complete: bool,
     *   missingFields: array<ValidationMissingField>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->complete = $values['complete'];
        $this->missingFields = $values['missingFields'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
