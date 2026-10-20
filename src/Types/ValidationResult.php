<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Core\Types\ArrayType;

/**
 * Whether the application's stored records meet the requirements for the services it requests.
 */
class ValidationResult extends JsonSerializableType
{
    /**
     * @var bool $valid Whether nothing is missing or invalid in any section.
     */
    #[JsonProperty('valid')]
    public bool $valid;

    /**
     * @var array<string> $servicesEvaluated The requirement groups that validation checked, named with Payabli's internal service names (for example, `payInCard` for the `Card` Pay In service).
     */
    #[JsonProperty('servicesEvaluated'), ArrayType(['string'])]
    public array $servicesEvaluated;

    /**
     * @var ValidationSections $sections
     */
    #[JsonProperty('sections')]
    public ValidationSections $sections;

    /**
     * @param array{
     *   valid: bool,
     *   servicesEvaluated: array<string>,
     *   sections: ValidationSections,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->valid = $values['valid'];
        $this->servicesEvaluated = $values['servicesEvaluated'];
        $this->sections = $values['sections'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
