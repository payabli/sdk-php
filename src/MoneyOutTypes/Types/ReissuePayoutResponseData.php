<?php

namespace Payabli\MoneyOutTypes\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

class ReissuePayoutResponseData extends JsonSerializableType
{
    /**
     * @var string $transactionId The transaction ID of the newly created payout.
     */
    #[JsonProperty('transactionId')]
    public string $transactionId;

    /**
     * @var string $status The status of the new transaction.
     */
    #[JsonProperty('status')]
    public string $status;

    /**
     * @var ?string $originalTransactionId The transaction ID of the original payout that was reissued.
     */
    #[JsonProperty('originalTransactionId')]
    public ?string $originalTransactionId;

    /**
     * @param array{
     *   transactionId: string,
     *   status: string,
     *   originalTransactionId?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->transactionId = $values['transactionId'];
        $this->status = $values['status'];
        $this->originalTransactionId = $values['originalTransactionId'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
