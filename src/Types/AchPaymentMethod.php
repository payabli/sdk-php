<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * ACH payment method.
 */
class AchPaymentMethod extends JsonSerializableType
{
    /**
     * @var ?string $storedMethodId ID of the stored ACH payment method. Required when using a previously saved ACH method when the vendor has more than one saved method. See the [Payouts with saved ACH payment methods](/developers/developer-guides/pay-out-manage-payouts) section for more details.
     */
    #[JsonProperty('storedMethodId')]
    public ?string $storedMethodId;

    /**
     * @param array{
     *   storedMethodId?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->storedMethodId = $values['storedMethodId'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
