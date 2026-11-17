<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * An address on a people search result. Search results use a shorter address
 * format than the person record: `street`, `city`, `state`, and `zip`.
 */
class PeopleSearchAddressResponse extends JsonSerializableType
{
    /**
     * @var ?string $street The street address.
     */
    #[JsonProperty('street')]
    public ?string $street;

    /**
     * @var ?string $city The city.
     */
    #[JsonProperty('city')]
    public ?string $city;

    /**
     * @var ?string $state The state or province.
     */
    #[JsonProperty('state')]
    public ?string $state;

    /**
     * @var ?string $zip The ZIP or postal code.
     */
    #[JsonProperty('zip')]
    public ?string $zip;

    /**
     * @param array{
     *   street?: ?string,
     *   city?: ?string,
     *   state?: ?string,
     *   zip?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->street = $values['street'] ?? null;
        $this->city = $values['city'] ?? null;
        $this->state = $values['state'] ?? null;
        $this->zip = $values['zip'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
