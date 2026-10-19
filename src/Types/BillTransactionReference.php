<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * Identifies a payout transaction that paid a bill.
 */
class BillTransactionReference extends JsonSerializableType
{
    /**
     * @var int $idOut Identifier of the payout transaction.
     */
    #[JsonProperty('idOut')]
    public int $idOut;

    /**
     * @var ?string $paymentId Payment ID of the payout transaction.
     */
    #[JsonProperty('paymentId')]
    public ?string $paymentId;

    /**
     * @param array{
     *   idOut: int,
     *   paymentId?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->idOut = $values['idOut'];
        $this->paymentId = $values['paymentId'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
