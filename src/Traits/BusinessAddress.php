<?php

namespace Payabli\Traits;

use Payabli\Types\AddressType;
use Payabli\Types\BusinessAddressLocation;
use Payabli\Core\Json\JsonProperty;

/**
 * An address associated with a business.
 *
 * @property ?value-of<AddressType> $type
 * @property ?value-of<BusinessAddressLocation> $location
 * @property ?string $addressLine1
 * @property ?string $addressLine2
 * @property ?string $cityLocality
 * @property ?string $stateProvince
 * @property ?string $postalCode
 * @property ?string $country
 * @property ?string $floor
 * @property ?string $suiteApartNumber
 */
trait BusinessAddress
{
    /**
     * @var ?value-of<AddressType> $type The address role.
     */
    #[JsonProperty('type')]
    public ?string $type;

    /**
     * @var ?value-of<BusinessAddressLocation> $location The physical use of the address. Defaults to `other`.
     */
    #[JsonProperty('location')]
    public ?string $location;

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
     * @var ?string $stateProvince The state or province.
     */
    #[JsonProperty('stateProvince')]
    public ?string $stateProvince;

    /**
     * @var ?string $postalCode The postal or ZIP code.
     */
    #[JsonProperty('postalCode')]
    public ?string $postalCode;

    /**
     * @var ?string $country The two-character ISO country code.
     */
    #[JsonProperty('country')]
    public ?string $country;

    /**
     * @var ?string $floor The floor, if applicable.
     */
    #[JsonProperty('floor')]
    public ?string $floor;

    /**
     * @var ?string $suiteApartNumber The suite or apartment number, if applicable.
     */
    #[JsonProperty('suiteApartNumber')]
    public ?string $suiteApartNumber;
}
