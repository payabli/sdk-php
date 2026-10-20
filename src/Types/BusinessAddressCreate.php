<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Traits\BusinessAddress;

/**
 * An address sent when creating a business. `country` is required.
 */
class BusinessAddressCreate extends JsonSerializableType
{
    use BusinessAddress;


    /**
     * @param array{
     *   type?: ?value-of<AddressType>,
     *   location?: ?value-of<BusinessAddressLocation>,
     *   addressLine1?: ?string,
     *   addressLine2?: ?string,
     *   cityLocality?: ?string,
     *   stateProvince?: ?string,
     *   postalCode?: ?string,
     *   country?: ?string,
     *   floor?: ?string,
     *   suiteApartNumber?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->type = $values['type'] ?? null;
        $this->location = $values['location'] ?? null;
        $this->addressLine1 = $values['addressLine1'] ?? null;
        $this->addressLine2 = $values['addressLine2'] ?? null;
        $this->cityLocality = $values['cityLocality'] ?? null;
        $this->stateProvince = $values['stateProvince'] ?? null;
        $this->postalCode = $values['postalCode'] ?? null;
        $this->country = $values['country'] ?? null;
        $this->floor = $values['floor'] ?? null;
        $this->suiteApartNumber = $values['suiteApartNumber'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
