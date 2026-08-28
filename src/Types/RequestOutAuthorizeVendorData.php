<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * Vendor to pay with this payout. Create the vendor first with
 * [Create vendor](/developers/api-reference/vendor/create-vendor), then
 * reference it here by `vendorNumber` or `vendorId`.
 */
class RequestOutAuthorizeVendorData extends JsonSerializableType
{
    /**
     * @var ?string $vendorNumber
     */
    #[JsonProperty('vendorNumber')]
    public ?string $vendorNumber;

    /**
     * @var ?int $vendorId Payabli identifier for the vendor record. Required when `vendorNumber` isn't included.
     */
    #[JsonProperty('vendorId')]
    public ?int $vendorId;

    /**
     * @param array{
     *   vendorNumber?: ?string,
     *   vendorId?: ?int,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->vendorNumber = $values['vendorNumber'] ?? null;
        $this->vendorId = $values['vendorId'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
