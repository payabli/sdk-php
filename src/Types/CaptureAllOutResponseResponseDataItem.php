<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

class CaptureAllOutResponseResponseDataItem extends JsonSerializableType
{
    /**
     * @var ?int $customerId Payabli-generated unique ID of the vendor on the payout. Returns the same value as `VendorId`, or `0` when no vendor is associated.
     */
    #[JsonProperty('CustomerId')]
    public ?int $customerId;

    /**
     * @var ?int $vendorId Payabli-generated unique ID of the vendor on the payout. Returns the same value as `CustomerId`, or `0` when no vendor is associated.
     */
    #[JsonProperty('VendorId')]
    public ?int $vendorId;

    /**
     * @var ?string $referenceId
     */
    #[JsonProperty('ReferenceId')]
    public ?string $referenceId;

    /**
     * @var ?int $resultCode
     */
    #[JsonProperty('ResultCode')]
    public ?int $resultCode;

    /**
     * Text describing the result.
     * If `ResultCode` = 1, returns 'Authorized'.
     * If `ResultCode` = 2 or 3, this contains the cause of the decline.
     *
     * @var ?string $resultText
     */
    #[JsonProperty('ResultText')]
    public ?string $resultText;

    /**
     * @param array{
     *   customerId?: ?int,
     *   vendorId?: ?int,
     *   referenceId?: ?string,
     *   resultCode?: ?int,
     *   resultText?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->customerId = $values['customerId'] ?? null;
        $this->vendorId = $values['vendorId'] ?? null;
        $this->referenceId = $values['referenceId'] ?? null;
        $this->resultCode = $values['resultCode'] ?? null;
        $this->resultText = $values['resultText'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
