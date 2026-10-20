<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * Hypermedia links for a payment method resource.
 */
class PaymentMethodLinks extends JsonSerializableType
{
    /**
     * @var ?string $self Relative path to the payment method resource.
     */
    #[JsonProperty('self')]
    public ?string $self;

    /**
     * @var ?string $owner Relative path to the entity that owns the payment method.
     */
    #[JsonProperty('owner')]
    public ?string $owner;

    /**
     * @param array{
     *   self?: ?string,
     *   owner?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->self = $values['self'] ?? null;
        $this->owner = $values['owner'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
