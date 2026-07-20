<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * The vendor associated with the bill. Although you can create a vendor
 * in a create bill request, Payabli recommends creating a vendor
 * separately and passing a valid `vendorNumber` here. At minimum, the
 * `vendorNumber` is required.
 */
class BillOutDataVendor extends JsonSerializableType
{
    /**
     * @var ?string $vendorNumber
     */
    #[JsonProperty('vendorNumber')]
    public ?string $vendorNumber;

    /**
     * @param array{
     *   vendorNumber?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->vendorNumber = $values['vendorNumber'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
