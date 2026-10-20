<?php

namespace Payabli\Businesses\Requests;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Types\AddressType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Types\BusinessAddressLocation;

class CreateBusinessAddressRequest extends JsonSerializableType
{
    /**
     * @var value-of<AddressType> $type The address role.
     */
    #[JsonProperty('type')]
    public string $type;

    /**
     * @var ?value-of<BusinessAddressLocation> $location The physical use of the address.
     */
    #[JsonProperty('location')]
    public ?string $location;

    /**
     * @var string $addressLine1 The first line of the street address.
     */
    #[JsonProperty('addressLine1')]
    public string $addressLine1;

    /**
     * @var ?string $addressLine2 The second line of the street address.
     */
    #[JsonProperty('addressLine2')]
    public ?string $addressLine2;

    /**
     * @var string $cityLocality The city or locality.
     */
    #[JsonProperty('cityLocality')]
    public string $cityLocality;

    /**
     * @var string $stateProvince The state or province.
     */
    #[JsonProperty('stateProvince')]
    public string $stateProvince;

    /**
     * @var string $postalCode The postal or ZIP code.
     */
    #[JsonProperty('postalCode')]
    public string $postalCode;

    /**
     * @var string $country The two-character ISO country code.
     */
    #[JsonProperty('country')]
    public string $country;

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

    /**
     * @param array{
     *   type: value-of<AddressType>,
     *   addressLine1: string,
     *   cityLocality: string,
     *   stateProvince: string,
     *   postalCode: string,
     *   country: string,
     *   location?: ?value-of<BusinessAddressLocation>,
     *   addressLine2?: ?string,
     *   floor?: ?string,
     *   suiteApartNumber?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->type = $values['type'];
        $this->location = $values['location'] ?? null;
        $this->addressLine1 = $values['addressLine1'];
        $this->addressLine2 = $values['addressLine2'] ?? null;
        $this->cityLocality = $values['cityLocality'];
        $this->stateProvince = $values['stateProvince'];
        $this->postalCode = $values['postalCode'];
        $this->country = $values['country'];
        $this->floor = $values['floor'] ?? null;
        $this->suiteApartNumber = $values['suiteApartNumber'] ?? null;
    }
}
