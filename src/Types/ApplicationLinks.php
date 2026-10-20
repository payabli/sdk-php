<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * Hypermedia links for an application resource.
 */
class ApplicationLinks extends JsonSerializableType
{
    /**
     * @var ?string $self Relative path to the application resource.
     */
    #[JsonProperty('self')]
    public ?string $self;

    /**
     * @var ?string $business Relative path to the business the application boards.
     */
    #[JsonProperty('business')]
    public ?string $business;

    /**
     * @param array{
     *   self?: ?string,
     *   business?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->self = $values['self'] ?? null;
        $this->business = $values['business'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
