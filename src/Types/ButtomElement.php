<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

class ButtomElement extends JsonSerializableType
{
    /**
     * @var ?string $label Label for custom payment button
     */
    #[JsonProperty('label')]
    public ?string $label;

    /**
     * @var ?value-of<ButtomElementSize> $size Specify size of custom payment button
     */
    #[JsonProperty('size')]
    public ?string $size;

    /**
     * @param array{
     *   label?: ?string,
     *   size?: ?value-of<ButtomElementSize>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->label = $values['label'] ?? null;
        $this->size = $values['size'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
