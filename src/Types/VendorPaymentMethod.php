<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * Object containing details about the payment method to use for the payout.
 */
class VendorPaymentMethod extends JsonSerializableType
{
    /**
     * @var ?value-of<VendorPaymentMethodMethod> $method Payment method to use for payout. Leave empty for managed payables.
     */
    #[JsonProperty('method')]
    public ?string $method;

    /**
     * @param array{
     *   method?: ?value-of<VendorPaymentMethodMethod>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->method = $values['method'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
