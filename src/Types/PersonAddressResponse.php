<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * An address in a person response.
 */
class PersonAddressResponse extends JsonSerializableType
{
    /**
     * @var ?string $addressLine1 The first line of the street address.
     */
    #[JsonProperty('addressLine1')]
    public ?string $addressLine1;

    /**
     * @var ?string $addressLine2 The second line of the street address.
     */
    #[JsonProperty('addressLine2')]
    public ?string $addressLine2;

    /**
     * @var ?string $cityLocality The city or locality.
     */
    #[JsonProperty('cityLocality')]
    public ?string $cityLocality;

    /**
     * @var ?string $stateProvince The two-letter state or province code.
     */
    #[JsonProperty('stateProvince')]
    public ?string $stateProvince;

    /**
     * @var ?string $postalCode The postal or ZIP code.
     */
    #[JsonProperty('postalCode')]
    public ?string $postalCode;

    /**
     * @var ?string $country The two-letter ISO 3166-1 alpha-2 country code.
     */
    #[JsonProperty('country')]
    public ?string $country;

    /**
     * @var ?string $type The role the address plays for the person, for example `legal` or `physical`.
     */
    #[JsonProperty('type')]
    public ?string $type;

    /**
     * @param array{
     *   addressLine1?: ?string,
     *   addressLine2?: ?string,
     *   cityLocality?: ?string,
     *   stateProvince?: ?string,
     *   postalCode?: ?string,
     *   country?: ?string,
     *   type?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->addressLine1 = $values['addressLine1'] ?? null;
        $this->addressLine2 = $values['addressLine2'] ?? null;
        $this->cityLocality = $values['cityLocality'] ?? null;
        $this->stateProvince = $values['stateProvince'] ?? null;
        $this->postalCode = $values['postalCode'] ?? null;
        $this->country = $values['country'] ?? null;
        $this->type = $values['type'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
