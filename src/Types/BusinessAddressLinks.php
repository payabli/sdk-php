<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * Hypermedia links for a business address resource.
 */
class BusinessAddressLinks extends JsonSerializableType
{
    /**
     * @var ?string $self Relative path to the business address resource.
     */
    #[JsonProperty('self')]
    public ?string $self;

    /**
     * @var ?string $business Relative path to the business that owns the address.
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
