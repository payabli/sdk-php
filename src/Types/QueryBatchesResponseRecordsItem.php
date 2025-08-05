<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use DateTime;
use Payabli\Core\Types\Date;

class QueryBatchesResponseRecordsItem extends JsonSerializableType
{
    /**
     * @var ?float $batchAmount The amount of the batch.
     */
    #[JsonProperty('BatchAmount')]
    public ?float $batchAmount;

    /**
     * @var ?float $batchAuthAmount
     */
    #[JsonProperty('BatchAuthAmount')]
    public ?float $batchAuthAmount;

    /**
     * @var ?DateTime $batchDate The batch date.
     */
    #[JsonProperty('BatchDate'), Date(Date::TYPE_DATETIME)]
    public ?DateTime $batchDate;

    /**
     * @var ?float $batchFeesAmount The total of fees in the batch.
     */
    #[JsonProperty('BatchFeesAmount')]
    public ?float $batchFeesAmount;

    /**
     * @var ?float $batchHoldAmount The total amount of the batch that's being held for fraud or risk concerns.
     */
    #[JsonProperty('BatchHoldAmount')]
    public ?float $batchHoldAmount;

    /**
     * @var ?string $batchNumber
     */
    #[JsonProperty('BatchNumber')]
    public ?string $batchNumber;

    /**
     * @var ?int $batchRecords The number of records in the batch.
     */
    #[JsonProperty('BatchRecords')]
    public ?int $batchRecords;

    /**
     * @var ?float $batchRefundAmount The total amount of refunds deducted from batch.
     */
    #[JsonProperty('BatchRefundAmount')]
    public ?float $batchRefundAmount;

    /**
     * @var ?float $batchReleasedAmount Previously held funds that have been released after a risk review.
     */
    #[JsonProperty('BatchReleasedAmount')]
    public ?float $batchReleasedAmount;

    /**
     * @var ?float $batchReturnedAmount Total amount of ACH returns deducted from batch.
     */
    #[JsonProperty('BatchReturnedAmount')]
    public ?float $batchReturnedAmount;

    /**
     * @var ?float $batchSplitAmount Total of split transactions that included split funding instructions at the time of authorization.
     */
    #[JsonProperty('BatchSplitAmount')]
    public ?float $batchSplitAmount;

    /**
     * @var ?int $batchStatus The batch status. See [Batch Status](/developers/references/money-in-statuses#batch-status) for more.
     */
    #[JsonProperty('BatchStatus')]
    public ?int $batchStatus;

    /**
     * @var ?string $connectorName
     */
    #[JsonProperty('ConnectorName')]
    public ?string $connectorName;

    /**
     * @var ?DateTime $depositDate
     */
    #[JsonProperty('DepositDate'), Date(Date::TYPE_DATETIME)]
    public ?DateTime $depositDate;

    /**
     * @var ?string $entryName
     */
    #[JsonProperty('EntryName')]
    public ?string $entryName;

    /**
     * @var ?DateTime $expectedDepositDate
     */
    #[JsonProperty('ExpectedDepositDate'), Date(Date::TYPE_DATETIME)]
    public ?DateTime $expectedDepositDate;

    /**
     * @var ?string $externalPaypointId
     */
    #[JsonProperty('externalPaypointID')]
    public ?string $externalPaypointId;

    /**
     * @var ?int $idBatch The batch ID.
     */
    #[JsonProperty('IdBatch')]
    public ?int $idBatch;

    /**
     * @var ?string $method The payment method used.
     */
    #[JsonProperty('Method')]
    public ?string $method;

    /**
     * @var ?string $parentOrgName The entrypoint's parent org.
     */
    #[JsonProperty('ParentOrgName')]
    public ?string $parentOrgName;

    /**
     * @var ?string $paypointDba Paypoint DBA name.
     */
    #[JsonProperty('PaypointDba')]
    public ?string $paypointDba;

    /**
     * @var ?int $paypointId
     */
    #[JsonProperty('PaypointId')]
    public ?int $paypointId;

    /**
     * @var ?string $paypointName Paypoint legal name.
     */
    #[JsonProperty('PaypointName')]
    public ?string $paypointName;

    /**
     * @var ?string $transfer
     */
    #[JsonProperty('Transfer')]
    public ?string $transfer;

    /**
     * @var ?DateTime $transferDate The batch transfer date.
     */
    #[JsonProperty('TransferDate'), Date(Date::TYPE_DATETIME)]
    public ?DateTime $transferDate;

    /**
     * @param array{
     *   batchAmount?: ?float,
     *   batchAuthAmount?: ?float,
     *   batchDate?: ?DateTime,
     *   batchFeesAmount?: ?float,
     *   batchHoldAmount?: ?float,
     *   batchNumber?: ?string,
     *   batchRecords?: ?int,
     *   batchRefundAmount?: ?float,
     *   batchReleasedAmount?: ?float,
     *   batchReturnedAmount?: ?float,
     *   batchSplitAmount?: ?float,
     *   batchStatus?: ?int,
     *   connectorName?: ?string,
     *   depositDate?: ?DateTime,
     *   entryName?: ?string,
     *   expectedDepositDate?: ?DateTime,
     *   externalPaypointId?: ?string,
     *   idBatch?: ?int,
     *   method?: ?string,
     *   parentOrgName?: ?string,
     *   paypointDba?: ?string,
     *   paypointId?: ?int,
     *   paypointName?: ?string,
     *   transfer?: ?string,
     *   transferDate?: ?DateTime,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->batchAmount = $values['batchAmount'] ?? null;
        $this->batchAuthAmount = $values['batchAuthAmount'] ?? null;
        $this->batchDate = $values['batchDate'] ?? null;
        $this->batchFeesAmount = $values['batchFeesAmount'] ?? null;
        $this->batchHoldAmount = $values['batchHoldAmount'] ?? null;
        $this->batchNumber = $values['batchNumber'] ?? null;
        $this->batchRecords = $values['batchRecords'] ?? null;
        $this->batchRefundAmount = $values['batchRefundAmount'] ?? null;
        $this->batchReleasedAmount = $values['batchReleasedAmount'] ?? null;
        $this->batchReturnedAmount = $values['batchReturnedAmount'] ?? null;
        $this->batchSplitAmount = $values['batchSplitAmount'] ?? null;
        $this->batchStatus = $values['batchStatus'] ?? null;
        $this->connectorName = $values['connectorName'] ?? null;
        $this->depositDate = $values['depositDate'] ?? null;
        $this->entryName = $values['entryName'] ?? null;
        $this->expectedDepositDate = $values['expectedDepositDate'] ?? null;
        $this->externalPaypointId = $values['externalPaypointId'] ?? null;
        $this->idBatch = $values['idBatch'] ?? null;
        $this->method = $values['method'] ?? null;
        $this->parentOrgName = $values['parentOrgName'] ?? null;
        $this->paypointDba = $values['paypointDba'] ?? null;
        $this->paypointId = $values['paypointId'] ?? null;
        $this->paypointName = $values['paypointName'] ?? null;
        $this->transfer = $values['transfer'] ?? null;
        $this->transferDate = $values['transferDate'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
