<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use DateTime;
use Payabli\Core\Types\Date;
use Payabli\Core\Types\ArrayType;

class QueryBatchesResponseRecordsItem extends JsonSerializableType
{
    /**
     * @var ?value-of<AchHolderType> $achHolderType
     */
    #[JsonProperty('AchHolderType')]
    public ?string $achHolderType;

    /**
     * @var ?string $achSecCode
     */
    #[JsonProperty('AchSecCode')]
    public ?string $achSecCode;

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
     * @var ?int $chargebackId
     */
    #[JsonProperty('ChargebackId')]
    public ?int $chargebackId;

    /**
     * Service Fee or sub-charge transaction associated to the main
     * transaction.
     *
     * @var ?array<QueryCFeeTransaction> $cfeeTransactions
     */
    #[JsonProperty('CfeeTransactions'), ArrayType([QueryCFeeTransaction::class])]
    public ?array $cfeeTransactions;

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
     * @var ?string $deviceId
     */
    #[JsonProperty('DeviceId')]
    public ?string $deviceId;

    /**
     * @var ?string $entryName
     */
    #[JsonProperty('EntryName')]
    public ?string $entryName;

    /**
     * @var ?int $entryPageid
     */
    #[JsonProperty('EntryPageid')]
    public ?int $entryPageid;

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
     * @var ?float $feeAmount
     */
    #[JsonProperty('FeeAmount')]
    public ?float $feeAmount;

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
     * @var ?int $orgId
     */
    #[JsonProperty('OrgId')]
    public ?int $orgId;

    /**
     * @var ?string $parentOrgName The entrypoint's parent org.
     */
    #[JsonProperty('ParentOrgName')]
    public ?string $parentOrgName;

    /**
     * @var ?int $paymentSettlementStatus The payment's settlement status.
     */
    #[JsonProperty('PaymentSettlementStatus')]
    public ?int $paymentSettlementStatus;

    /**
     * @var ?int $payorId
     */
    #[JsonProperty('PayorId')]
    public ?int $payorId;

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
     * @var ?string $paypointName
     */
    #[JsonProperty('PaypointName')]
    public ?string $paypointName;

    /**
     * @var ?float $pendingFeeAmount
     */
    #[JsonProperty('PendingFeeAmount')]
    public ?float $pendingFeeAmount;

    /**
     * @var ?int $refundId
     */
    #[JsonProperty('RefundId')]
    public ?int $refundId;

    /**
     * @var ?int $retrievalId
     */
    #[JsonProperty('RetrievalId')]
    public ?int $retrievalId;

    /**
     * @var ?int $returnedId
     */
    #[JsonProperty('ReturnedId')]
    public ?int $returnedId;

    /**
     * @var ?array<SplitFundingContent> $splitFundingInstructions Split funding instructions for the transaction
     */
    #[JsonProperty('splitFundingInstructions'), ArrayType([SplitFundingContent::class])]
    public ?array $splitFundingInstructions;

    /**
     * @var ?float $totalAmount Total amount of the batch.
     */
    #[JsonProperty('TotalAmount')]
    public ?float $totalAmount;

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
     *   achHolderType?: ?value-of<AchHolderType>,
     *   achSecCode?: ?string,
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
     *   chargebackId?: ?int,
     *   cfeeTransactions?: ?array<QueryCFeeTransaction>,
     *   connectorName?: ?string,
     *   depositDate?: ?DateTime,
     *   deviceId?: ?string,
     *   entryName?: ?string,
     *   entryPageid?: ?int,
     *   expectedDepositDate?: ?DateTime,
     *   externalPaypointId?: ?string,
     *   feeAmount?: ?float,
     *   idBatch?: ?int,
     *   method?: ?string,
     *   orgId?: ?int,
     *   parentOrgName?: ?string,
     *   paymentSettlementStatus?: ?int,
     *   payorId?: ?int,
     *   paypointDba?: ?string,
     *   paypointId?: ?int,
     *   paypointName?: ?string,
     *   pendingFeeAmount?: ?float,
     *   refundId?: ?int,
     *   retrievalId?: ?int,
     *   returnedId?: ?int,
     *   splitFundingInstructions?: ?array<SplitFundingContent>,
     *   totalAmount?: ?float,
     *   transfer?: ?string,
     *   transferDate?: ?DateTime,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->achHolderType = $values['achHolderType'] ?? null;
        $this->achSecCode = $values['achSecCode'] ?? null;
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
        $this->chargebackId = $values['chargebackId'] ?? null;
        $this->cfeeTransactions = $values['cfeeTransactions'] ?? null;
        $this->connectorName = $values['connectorName'] ?? null;
        $this->depositDate = $values['depositDate'] ?? null;
        $this->deviceId = $values['deviceId'] ?? null;
        $this->entryName = $values['entryName'] ?? null;
        $this->entryPageid = $values['entryPageid'] ?? null;
        $this->expectedDepositDate = $values['expectedDepositDate'] ?? null;
        $this->externalPaypointId = $values['externalPaypointId'] ?? null;
        $this->feeAmount = $values['feeAmount'] ?? null;
        $this->idBatch = $values['idBatch'] ?? null;
        $this->method = $values['method'] ?? null;
        $this->orgId = $values['orgId'] ?? null;
        $this->parentOrgName = $values['parentOrgName'] ?? null;
        $this->paymentSettlementStatus = $values['paymentSettlementStatus'] ?? null;
        $this->payorId = $values['payorId'] ?? null;
        $this->paypointDba = $values['paypointDba'] ?? null;
        $this->paypointId = $values['paypointId'] ?? null;
        $this->paypointName = $values['paypointName'] ?? null;
        $this->pendingFeeAmount = $values['pendingFeeAmount'] ?? null;
        $this->refundId = $values['refundId'] ?? null;
        $this->retrievalId = $values['retrievalId'] ?? null;
        $this->returnedId = $values['returnedId'] ?? null;
        $this->splitFundingInstructions = $values['splitFundingInstructions'] ?? null;
        $this->totalAmount = $values['totalAmount'] ?? null;
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
