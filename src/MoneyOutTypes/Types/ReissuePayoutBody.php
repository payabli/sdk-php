<?php

namespace Payabli\MoneyOutTypes\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * Request body for reissuing a payout transaction.
 */
class ReissuePayoutBody extends JsonSerializableType
{
    /**
     * @var ReissuePaymentMethod $paymentMethod
     */
    #[JsonProperty('paymentMethod')]
    public ReissuePaymentMethod $paymentMethod;

    /**
     * @param array{
     *   paymentMethod: ReissuePaymentMethod,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->paymentMethod = $values['paymentMethod'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
