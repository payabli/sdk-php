<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * A field that's missing or invalid for the requested services.
 */
class ValidationMissingField extends JsonSerializableType
{
    /**
     * @var string $field The field's path on the entity record to fix, such as `business.taxReference` or `business.processingMetrics.numberOfTransactions`.
     */
    #[JsonProperty('field')]
    public string $field;

    /**
     * @var string $label A human-readable name for the field.
     */
    #[JsonProperty('label')]
    public string $label;

    /**
     * @var string $reason A short code for why the field failed, such as `required`.
     */
    #[JsonProperty('reason')]
    public string $reason;

    /**
     * @param array{
     *   field: string,
     *   label: string,
     *   reason: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->field = $values['field'];
        $this->label = $values['label'];
        $this->reason = $values['reason'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
