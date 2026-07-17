<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use DateTime;
use Payabli\Core\Types\Date;
use Payabli\Core\Types\ArrayType;

class QueryPayoutTransactionRecordsItem extends JsonSerializableType
{
    /**
     * @var ?int $idOut Identifier of payout transaction.
     */
    #[JsonProperty('IdOut')]
    public ?int $idOut;

    /**
     * @var ?DateTime $createdAt Timestamp when the payment was created, in UTC.
     */
    #[JsonProperty('CreatedAt'), Date(Date::TYPE_DATETIME)]
    public ?DateTime $createdAt;

    /**
     * @var ?string $comments Any comment or description for payout transaction.
     */
    #[JsonProperty('Comments')]
    public ?string $comments;

    /**
     * @var ?VendorQueryRecord $vendor Vendor related to the payout transaction.
     */
    #[JsonProperty('Vendor')]
    public ?VendorQueryRecord $vendor;

    /**
     * @var ?string $paypointDbaname
     */
    #[JsonProperty('PaypointDbaname')]
    public ?string $paypointDbaname;

    /**
     * @var ?string $paypointLegalname Paypoint legal name.
     */
    #[JsonProperty('PaypointLegalname')]
    public ?string $paypointLegalname;

    /**
     * @var ?int $paypointId
     */
    #[JsonProperty('PaypointId')]
    public ?int $paypointId;

    /**
     * @var ?int $status Internal status of transaction.
     */
    #[JsonProperty('Status')]
    public ?int $status;

    /**
     * @var ?string $paymentId
     */
    #[JsonProperty('PaymentId')]
    public ?string $paymentId;

    /**
     * @var ?string $transId ID of the transaction linked to this payout, when applicable.
     */
    #[JsonProperty('TransId')]
    public ?string $transId;

    /**
     * @var ?int $transStatus Status of the linked transaction.
     */
    #[JsonProperty('TransStatus')]
    public ?int $transStatus;

    /**
     * @var ?string $transStatusDetail Detailed status of the linked transaction.
     */
    #[JsonProperty('TransStatusDetail')]
    public ?string $transStatusDetail;

    /**
     * @var ?string $transStatusName Name of the linked transaction's status.
     */
    #[JsonProperty('TransStatusName')]
    public ?string $transStatusName;

    /**
     * @var ?string $transStatusCategory Category of the linked transaction's status.
     */
    #[JsonProperty('TransStatusCategory')]
    public ?string $transStatusCategory;

    /**
     * @var ?DateTime $lastUpdated Timestamp when payment record was updated.
     */
    #[JsonProperty('LastUpdated'), Date(Date::TYPE_DATETIME)]
    public ?DateTime $lastUpdated;

    /**
     * @var ?float $totalAmount Transaction total amount (including service fee or sub-charge).
     */
    #[JsonProperty('TotalAmount')]
    public ?float $totalAmount;

    /**
     * @var ?float $netAmount Net amount paid.
     */
    #[JsonProperty('NetAmount')]
    public ?float $netAmount;

    /**
     * @var ?float $feeAmount
     */
    #[JsonProperty('FeeAmount')]
    public ?float $feeAmount;

    /**
     * @var ?string $source
     */
    #[JsonProperty('Source')]
    public ?string $source;

    /**
     * @var ?string $parentOrgName
     */
    #[JsonProperty('ParentOrgName')]
    public ?string $parentOrgName;

    /**
     * @var ?int $parentOrgId
     */
    #[JsonProperty('ParentOrgId')]
    public ?int $parentOrgId;

    /**
     * @var ?string $batchNumber
     */
    #[JsonProperty('BatchNumber')]
    public ?string $batchNumber;

    /**
     * @var ?string $paymentStatus Status of payout transaction. See [Payout Transaction Statuses](/guides/pay-out-status-reference#payout-transaction-statuses) for a full reference.
     */
    #[JsonProperty('PaymentStatus')]
    public ?string $paymentStatus;

    /**
     * @var ?string $paymentMethod The payment method for the transaction.
     */
    #[JsonProperty('PaymentMethod')]
    public ?string $paymentMethod;

    /**
     * @var ?string $cardToken
     */
    #[JsonProperty('CardToken')]
    public ?string $cardToken;

    /**
     * @var ?string $checkNumber Paper check number related to payout transaction.
     */
    #[JsonProperty('CheckNumber')]
    public ?string $checkNumber;

    /**
     * @var ?FileContent $checkData Object referencing paper check image.
     */
    #[JsonProperty('CheckData')]
    public ?FileContent $checkData;

    /**
     * @var ?QueryPayoutTransactionRecordsItemPaymentData $paymentData
     */
    #[JsonProperty('PaymentData')]
    public ?QueryPayoutTransactionRecordsItemPaymentData $paymentData;

    /**
     * @var ?array<BillPayOutData> $bills Bills associated with this transaction.
     */
    #[JsonProperty('Bills'), ArrayType([BillPayOutData::class])]
    public ?array $bills;

    /**
     * @var ?array<QueryTransactionEvents> $events Events associated with this transaction.
     */
    #[JsonProperty('Events'), ArrayType([QueryTransactionEvents::class])]
    public ?array $events;

    /**
     * @var ?string $externalPaypointId
     */
    #[JsonProperty('externalPaypointID')]
    public ?string $externalPaypointId;

    /**
     * @var ?string $entryName
     */
    #[JsonProperty('EntryName')]
    public ?string $entryName;

    /**
     * @var ?string $gateway
     */
    #[JsonProperty('Gateway')]
    public ?string $gateway;

    /**
     * @var ?int $batchId Identifier of the batch associated with payout transaction.
     */
    #[JsonProperty('BatchId')]
    public ?int $batchId;

    /**
     * @var ?bool $hasVcardTransactions
     */
    #[JsonProperty('HasVcardTransactions')]
    public ?bool $hasVcardTransactions;

    /**
     * @var ?bool $isSameDayAch
     */
    #[JsonProperty('IsSameDayACH')]
    public ?bool $isSameDayAch;

    /**
     * @var ?int $scheduleId
     */
    #[JsonProperty('ScheduleId')]
    public ?int $scheduleId;

    /**
     * @var ?string $settlementStatus
     */
    #[JsonProperty('SettlementStatus')]
    public ?string $settlementStatus;

    /**
     * @var ?string $settlementStatusName
     */
    #[JsonProperty('SettlementStatusName')]
    public ?string $settlementStatusName;

    /**
     * @var ?DateTime $settlementDate Date the payout settled, in UTC. Null until the payout settles.
     */
    #[JsonProperty('SettlementDate'), Date(Date::TYPE_DATETIME)]
    public ?DateTime $settlementDate;

    /**
     * @var ?bool $riskFlagged
     */
    #[JsonProperty('RiskFlagged')]
    public ?bool $riskFlagged;

    /**
     * @var ?DateTime $riskFlaggedOn
     */
    #[JsonProperty('RiskFlaggedOn'), Date(Date::TYPE_DATETIME)]
    public ?DateTime $riskFlaggedOn;

    /**
     * @var ?string $riskStatus
     */
    #[JsonProperty('RiskStatus')]
    public ?string $riskStatus;

    /**
     * @var ?string $riskReason
     */
    #[JsonProperty('RiskReason')]
    public ?string $riskReason;

    /**
     * @var ?string $riskAction
     */
    #[JsonProperty('RiskAction')]
    public ?string $riskAction;

    /**
     * @var ?int $riskActionCode
     */
    #[JsonProperty('RiskActionCode')]
    public ?int $riskActionCode;

    /**
     * @var ?string $payoutProgram
     */
    #[JsonProperty('PayoutProgram')]
    public ?string $payoutProgram;

    /**
     * @var ?string $achTraceNumber ACH trace number for the payout, when available.
     */
    #[JsonProperty('AchTraceNumber')]
    public ?string $achTraceNumber;

    /**
     * @var ?string $entityId Unique identifier (ULID) of the payout transaction.
     */
    #[JsonProperty('EntityId')]
    public ?string $entityId;

    /**
     * @param array{
     *   idOut?: ?int,
     *   createdAt?: ?DateTime,
     *   comments?: ?string,
     *   vendor?: ?VendorQueryRecord,
     *   paypointDbaname?: ?string,
     *   paypointLegalname?: ?string,
     *   paypointId?: ?int,
     *   status?: ?int,
     *   paymentId?: ?string,
     *   transId?: ?string,
     *   transStatus?: ?int,
     *   transStatusDetail?: ?string,
     *   transStatusName?: ?string,
     *   transStatusCategory?: ?string,
     *   lastUpdated?: ?DateTime,
     *   totalAmount?: ?float,
     *   netAmount?: ?float,
     *   feeAmount?: ?float,
     *   source?: ?string,
     *   parentOrgName?: ?string,
     *   parentOrgId?: ?int,
     *   batchNumber?: ?string,
     *   paymentStatus?: ?string,
     *   paymentMethod?: ?string,
     *   cardToken?: ?string,
     *   checkNumber?: ?string,
     *   checkData?: ?FileContent,
     *   paymentData?: ?QueryPayoutTransactionRecordsItemPaymentData,
     *   bills?: ?array<BillPayOutData>,
     *   events?: ?array<QueryTransactionEvents>,
     *   externalPaypointId?: ?string,
     *   entryName?: ?string,
     *   gateway?: ?string,
     *   batchId?: ?int,
     *   hasVcardTransactions?: ?bool,
     *   isSameDayAch?: ?bool,
     *   scheduleId?: ?int,
     *   settlementStatus?: ?string,
     *   settlementStatusName?: ?string,
     *   settlementDate?: ?DateTime,
     *   riskFlagged?: ?bool,
     *   riskFlaggedOn?: ?DateTime,
     *   riskStatus?: ?string,
     *   riskReason?: ?string,
     *   riskAction?: ?string,
     *   riskActionCode?: ?int,
     *   payoutProgram?: ?string,
     *   achTraceNumber?: ?string,
     *   entityId?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->idOut = $values['idOut'] ?? null;
        $this->createdAt = $values['createdAt'] ?? null;
        $this->comments = $values['comments'] ?? null;
        $this->vendor = $values['vendor'] ?? null;
        $this->paypointDbaname = $values['paypointDbaname'] ?? null;
        $this->paypointLegalname = $values['paypointLegalname'] ?? null;
        $this->paypointId = $values['paypointId'] ?? null;
        $this->status = $values['status'] ?? null;
        $this->paymentId = $values['paymentId'] ?? null;
        $this->transId = $values['transId'] ?? null;
        $this->transStatus = $values['transStatus'] ?? null;
        $this->transStatusDetail = $values['transStatusDetail'] ?? null;
        $this->transStatusName = $values['transStatusName'] ?? null;
        $this->transStatusCategory = $values['transStatusCategory'] ?? null;
        $this->lastUpdated = $values['lastUpdated'] ?? null;
        $this->totalAmount = $values['totalAmount'] ?? null;
        $this->netAmount = $values['netAmount'] ?? null;
        $this->feeAmount = $values['feeAmount'] ?? null;
        $this->source = $values['source'] ?? null;
        $this->parentOrgName = $values['parentOrgName'] ?? null;
        $this->parentOrgId = $values['parentOrgId'] ?? null;
        $this->batchNumber = $values['batchNumber'] ?? null;
        $this->paymentStatus = $values['paymentStatus'] ?? null;
        $this->paymentMethod = $values['paymentMethod'] ?? null;
        $this->cardToken = $values['cardToken'] ?? null;
        $this->checkNumber = $values['checkNumber'] ?? null;
        $this->checkData = $values['checkData'] ?? null;
        $this->paymentData = $values['paymentData'] ?? null;
        $this->bills = $values['bills'] ?? null;
        $this->events = $values['events'] ?? null;
        $this->externalPaypointId = $values['externalPaypointId'] ?? null;
        $this->entryName = $values['entryName'] ?? null;
        $this->gateway = $values['gateway'] ?? null;
        $this->batchId = $values['batchId'] ?? null;
        $this->hasVcardTransactions = $values['hasVcardTransactions'] ?? null;
        $this->isSameDayAch = $values['isSameDayAch'] ?? null;
        $this->scheduleId = $values['scheduleId'] ?? null;
        $this->settlementStatus = $values['settlementStatus'] ?? null;
        $this->settlementStatusName = $values['settlementStatusName'] ?? null;
        $this->settlementDate = $values['settlementDate'] ?? null;
        $this->riskFlagged = $values['riskFlagged'] ?? null;
        $this->riskFlaggedOn = $values['riskFlaggedOn'] ?? null;
        $this->riskStatus = $values['riskStatus'] ?? null;
        $this->riskReason = $values['riskReason'] ?? null;
        $this->riskAction = $values['riskAction'] ?? null;
        $this->riskActionCode = $values['riskActionCode'] ?? null;
        $this->payoutProgram = $values['payoutProgram'] ?? null;
        $this->achTraceNumber = $values['achTraceNumber'] ?? null;
        $this->entityId = $values['entityId'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
