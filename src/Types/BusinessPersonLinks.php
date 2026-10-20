<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * Hypermedia links for a business-person link.
 */
class BusinessPersonLinks extends JsonSerializableType
{
    /**
     * @var ?string $self Relative path to the business-person link.
     */
    #[JsonProperty('self')]
    public ?string $self;

    /**
     * @var ?string $business Relative path to the linked business.
     */
    #[JsonProperty('business')]
    public ?string $business;

    /**
     * @var ?string $person Relative path to the linked person.
     */
    #[JsonProperty('person')]
    public ?string $person;

    /**
     * @param array{
     *   self?: ?string,
     *   business?: ?string,
     *   person?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->self = $values['self'] ?? null;
        $this->business = $values['business'] ?? null;
        $this->person = $values['person'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
