<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * Hypermedia links for a business resource.
 */
class BusinessLinks extends JsonSerializableType
{
    /**
     * @var ?string $self Relative path to the business resource.
     */
    #[JsonProperty('self')]
    public ?string $self;

    /**
     * @param array{
     *   self?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->self = $values['self'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
