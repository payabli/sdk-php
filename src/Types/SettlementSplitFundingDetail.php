<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * A split funding instruction on a settled transaction, enriched with the batch and transfer that paid out the split when that information is available. Returned by the settlement query endpoints.
 */
class SettlementSplitFundingDetail extends JsonSerializableType
{
    /**
     * @var ?string $recipientEntryPoint The entrypoint the split was sent to.
     */
    #[JsonProperty('recipientEntryPoint')]
    public ?string $recipientEntryPoint;

    /**
     * @var ?string $accountId The account the split was sent to.
     */
    #[JsonProperty('AccountId')]
    public ?string $accountId;

    /**
     * @var ?string $description A description for the split.
     */
    #[JsonProperty('Description')]
    public ?string $description;

    /**
     * @var ?float $amount The amount of the transaction sent to this recipient as a split.
     */
    #[JsonProperty('Amount')]
    public ?float $amount;

    /**
     * @var ?string $batchNumber The batch number the split was paid out in. Null when the batch isn't available.
     */
    #[JsonProperty('batchNumber')]
    public ?string $batchNumber;

    /**
     * @var ?int $transferId Identifier of the transfer that carried the split. Null when the transfer isn't available.
     */
    #[JsonProperty('transferId')]
    public ?int $transferId;

    /**
     * @var ?float $transferAmount The total amount of the transfer that carried this split.
     */
    #[JsonProperty('transferAmount')]
    public ?float $transferAmount;

    /**
     * @param array{
     *   recipientEntryPoint?: ?string,
     *   accountId?: ?string,
     *   description?: ?string,
     *   amount?: ?float,
     *   batchNumber?: ?string,
     *   transferId?: ?int,
     *   transferAmount?: ?float,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->recipientEntryPoint = $values['recipientEntryPoint'] ?? null;
        $this->accountId = $values['accountId'] ?? null;
        $this->description = $values['description'] ?? null;
        $this->amount = $values['amount'] ?? null;
        $this->batchNumber = $values['batchNumber'] ?? null;
        $this->transferId = $values['transferId'] ?? null;
        $this->transferAmount = $values['transferAmount'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
