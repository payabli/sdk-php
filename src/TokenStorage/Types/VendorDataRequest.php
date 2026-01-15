<?php

namespace Payabli\TokenStorage\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * Object describing the vendor owner of payment method. Required when saving an ACH payment method on behalf of a vendor (for Pay Out transactions).
 */
class VendorDataRequest extends JsonSerializableType
{
    /**
     * @var ?int $vendorId The unique numeric ID assigned to the vendor in Payabli. Either `vendorId` or `vendorNumber` is required.
     */
    #[JsonProperty('vendorId')]
    public ?int $vendorId;

    /**
     * @var ?string $vendorNumber Custom vendor number assigned by the business. Either `vendorId` or `vendorNumber` is required.
     */
    #[JsonProperty('vendorNumber')]
    public ?string $vendorNumber;

    /**
     * @param array{
     *   vendorId?: ?int,
     *   vendorNumber?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->vendorId = $values['vendorId'] ?? null;
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
