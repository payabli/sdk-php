<?php

namespace Payabli\QueryTypes\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Types\BillingFeeDetail;
use Payabli\Core\Types\ArrayType;

/**
 * A record representing an outbound transfer detail.
 */
class TransferOutDetailRecord extends JsonSerializableType
{
    /**
     * @var ?int $transferDetailId Unique identifier for the transfer detail.
     */
    #[JsonProperty('transferDetailId')]
    public ?int $transferDetailId;

    /**
     * @var ?int $transferId The ID of the transfer this detail belongs to.
     */
    #[JsonProperty('transferId')]
    public ?int $transferId;

    /**
     * @var ?string $transactionId The transaction ID in Payabli's system.
     */
    #[JsonProperty('transactionId')]
    public ?string $transactionId;

    /**
     * @var ?int $idOut The outbound transaction ID.
     */
    #[JsonProperty('IdOut')]
    public ?int $idOut;

    /**
     * @var ?string $method Payment method used.
     */
    #[JsonProperty('method')]
    public ?string $method;

    /**
     * @var ?string $type The transaction type (credit or debit).
     */
    #[JsonProperty('type')]
    public ?string $type;

    /**
     * @var ?string $category Category of the transaction detail.
     */
    #[JsonProperty('category')]
    public ?string $category;

    /**
     * @var ?float $grossAmount The gross amount of the transaction.
     */
    #[JsonProperty('grossAmount')]
    public ?float $grossAmount;

    /**
     * @var ?float $returnedAmount Amount returned.
     */
    #[JsonProperty('returnedAmount')]
    public ?float $returnedAmount;

    /**
     * @var ?float $refundAmount Amount refunded.
     */
    #[JsonProperty('refundAmount')]
    public ?float $refundAmount;

    /**
     * @var ?float $holdAmount Amount being held.
     */
    #[JsonProperty('holdAmount')]
    public ?float $holdAmount;

    /**
     * @var ?float $releasedAmount Amount released.
     */
    #[JsonProperty('releasedAmount')]
    public ?float $releasedAmount;

    /**
     * @var ?float $billingFeesAmount Billing fees amount.
     */
    #[JsonProperty('billingFeesAmount')]
    public ?float $billingFeesAmount;

    /**
     * @var ?float $adjustmentsAmount Adjustments amount.
     */
    #[JsonProperty('adjustmentsAmount')]
    public ?float $adjustmentsAmount;

    /**
     * @var ?float $netTransferAmount Net transfer amount after deductions.
     */
    #[JsonProperty('netTransferAmount')]
    public ?float $netTransferAmount;

    /**
     * @var ?array<BillingFeeDetail> $billingFeesDetails Detailed breakdown of billing fees.
     */
    #[JsonProperty('billingFeesDetails'), ArrayType([BillingFeeDetail::class])]
    public ?array $billingFeesDetails;

    /**
     * @var ?string $createdAt Date and time the record was created.
     */
    #[JsonProperty('CreatedAt')]
    public ?string $createdAt;

    /**
     * @var ?string $comments Comments on the transfer detail.
     */
    #[JsonProperty('Comments')]
    public ?string $comments;

    /**
     * @var ?TransferOutDetailVendor $vendor Vendor information.
     */
    #[JsonProperty('Vendor')]
    public ?TransferOutDetailVendor $vendor;

    /**
     * @var ?string $paypointDbaname DBA name of the paypoint.
     */
    #[JsonProperty('PaypointDbaname')]
    public ?string $paypointDbaname;

    /**
     * @var ?string $paypointLegalname Legal name of the paypoint.
     */
    #[JsonProperty('PaypointLegalname')]
    public ?string $paypointLegalname;

    /**
     * @var ?int $paypointId ID of the paypoint.
     */
    #[JsonProperty('PaypointId')]
    public ?int $paypointId;

    /**
     * @var ?int $status Status of the transfer detail.
     */
    #[JsonProperty('Status')]
    public ?int $status;

    /**
     * @var ?string $paymentId Payment ID.
     */
    #[JsonProperty('PaymentId')]
    public ?string $paymentId;

    /**
     * @var ?string $transId Transaction ID.
     */
    #[JsonProperty('TransId')]
    public ?string $transId;

    /**
     * @var ?int $transStatus Transaction status.
     */
    #[JsonProperty('TransStatus')]
    public ?int $transStatus;

    /**
     * @var ?string $transStatusDetail Detailed transaction status.
     */
    #[JsonProperty('TransStatusDetail')]
    public ?string $transStatusDetail;

    /**
     * @var ?string $transStatusName Name of the transaction status.
     */
    #[JsonProperty('TransStatusName')]
    public ?string $transStatusName;

    /**
     * @var ?string $transStatusCategory Category of the transaction status.
     */
    #[JsonProperty('TransStatusCategory')]
    public ?string $transStatusCategory;

    /**
     * @var ?string $lastUpdated Date and time the record was last updated.
     */
    #[JsonProperty('LastUpdated')]
    public ?string $lastUpdated;

    /**
     * @var ?float $totalAmount Total amount of the transaction.
     */
    #[JsonProperty('TotalAmount')]
    public ?float $totalAmount;

    /**
     * @var ?float $netAmount Net amount of the transaction.
     */
    #[JsonProperty('NetAmount')]
    public ?float $netAmount;

    /**
     * @var ?float $feeAmount Fee amount for the transaction.
     */
    #[JsonProperty('FeeAmount')]
    public ?float $feeAmount;

    /**
     * @var ?string $source Source of the transaction.
     */
    #[JsonProperty('Source')]
    public ?string $source;

    /**
     * @var ?string $parentOrgName Name of the parent organization.
     */
    #[JsonProperty('ParentOrgName')]
    public ?string $parentOrgName;

    /**
     * @var ?int $parentOrgId ID of the parent organization.
     */
    #[JsonProperty('ParentOrgId')]
    public ?int $parentOrgId;

    /**
     * @var ?string $batchNumber Batch number for the transfer.
     */
    #[JsonProperty('BatchNumber')]
    public ?string $batchNumber;

    /**
     * @var ?string $paymentStatus Status of the payment.
     */
    #[JsonProperty('PaymentStatus')]
    public ?string $paymentStatus;

    /**
     * @var ?string $paymentMethod Payment method used.
     */
    #[JsonProperty('PaymentMethod')]
    public ?string $paymentMethod;

    /**
     * @var ?string $cardToken Token for the card used.
     */
    #[JsonProperty('CardToken')]
    public ?string $cardToken;

    /**
     * @var ?string $checkNumber Check number if paid by check.
     */
    #[JsonProperty('CheckNumber')]
    public ?string $checkNumber;

    /**
     * @var ?TransferOutDetailCheckData $checkData Check data if paid by check.
     */
    #[JsonProperty('CheckData')]
    public ?TransferOutDetailCheckData $checkData;

    /**
     * @var ?TransferOutDetailPaymentData $paymentData Payment data for the transaction.
     */
    #[JsonProperty('PaymentData')]
    public ?TransferOutDetailPaymentData $paymentData;

    /**
     * @var ?array<TransferOutDetailBill> $bills Bills associated with the transfer.
     */
    #[JsonProperty('Bills'), ArrayType([TransferOutDetailBill::class])]
    public ?array $bills;

    /**
     * @var ?array<TransferOutDetailEvent> $events Events associated with the transfer.
     */
    #[JsonProperty('Events'), ArrayType([TransferOutDetailEvent::class])]
    public ?array $events;

    /**
     * @var ?string $externalPaypointId External paypoint ID.
     */
    #[JsonProperty('externalPaypointID')]
    public ?string $externalPaypointId;

    /**
     * @var ?string $entryName Entry name for the paypoint.
     */
    #[JsonProperty('EntryName')]
    public ?string $entryName;

    /**
     * @var ?string $gateway Gateway used for the transaction.
     */
    #[JsonProperty('Gateway')]
    public ?string $gateway;

    /**
     * @var ?int $batchId ID of the batch.
     */
    #[JsonProperty('BatchId')]
    public ?int $batchId;

    /**
     * @var ?bool $hasVcardTransactions Whether the transfer has virtual card transactions.
     */
    #[JsonProperty('HasVcardTransactions')]
    public ?bool $hasVcardTransactions;

    /**
     * @var ?bool $isSameDayAch Whether this is a same-day ACH transaction.
     */
    #[JsonProperty('IsSameDayACH')]
    public ?bool $isSameDayAch;

    /**
     * @var ?int $scheduleId ID of the schedule if applicable.
     */
    #[JsonProperty('ScheduleId')]
    public ?int $scheduleId;

    /**
     * @var ?string $settlementStatus Settlement status.
     */
    #[JsonProperty('SettlementStatus')]
    public ?string $settlementStatus;

    /**
     * @var ?string $settlementStatusName Name of the settlement status.
     */
    #[JsonProperty('SettlementStatusName')]
    public ?string $settlementStatusName;

    /**
     * @var ?string $settlementDate Date of settlement.
     */
    #[JsonProperty('SettlementDate')]
    public ?string $settlementDate;

    /**
     * @var ?bool $riskFlagged Whether the transaction was flagged for risk.
     */
    #[JsonProperty('RiskFlagged')]
    public ?bool $riskFlagged;

    /**
     * @var ?string $riskFlaggedOn Date and time the transaction was flagged.
     */
    #[JsonProperty('RiskFlaggedOn')]
    public ?string $riskFlaggedOn;

    /**
     * @var ?string $riskStatus Risk status of the transaction.
     */
    #[JsonProperty('RiskStatus')]
    public ?string $riskStatus;

    /**
     * @var ?string $riskReason Reason for the risk flag.
     */
    #[JsonProperty('RiskReason')]
    public ?string $riskReason;

    /**
     * @var ?string $riskAction Action taken for risk.
     */
    #[JsonProperty('RiskAction')]
    public ?string $riskAction;

    /**
     * @var ?int $riskActionCode Code for the risk action.
     */
    #[JsonProperty('RiskActionCode')]
    public ?int $riskActionCode;

    /**
     * @var ?string $payoutProgram Payout program used.
     */
    #[JsonProperty('PayoutProgram')]
    public ?string $payoutProgram;

    /**
     * @var ?string $achTraceNumber ACH trace number.
     */
    #[JsonProperty('AchTraceNumber')]
    public ?string $achTraceNumber;

    /**
     * @param array{
     *   transferDetailId?: ?int,
     *   transferId?: ?int,
     *   transactionId?: ?string,
     *   idOut?: ?int,
     *   method?: ?string,
     *   type?: ?string,
     *   category?: ?string,
     *   grossAmount?: ?float,
     *   returnedAmount?: ?float,
     *   refundAmount?: ?float,
     *   holdAmount?: ?float,
     *   releasedAmount?: ?float,
     *   billingFeesAmount?: ?float,
     *   adjustmentsAmount?: ?float,
     *   netTransferAmount?: ?float,
     *   billingFeesDetails?: ?array<BillingFeeDetail>,
     *   createdAt?: ?string,
     *   comments?: ?string,
     *   vendor?: ?TransferOutDetailVendor,
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
     *   lastUpdated?: ?string,
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
     *   checkData?: ?TransferOutDetailCheckData,
     *   paymentData?: ?TransferOutDetailPaymentData,
     *   bills?: ?array<TransferOutDetailBill>,
     *   events?: ?array<TransferOutDetailEvent>,
     *   externalPaypointId?: ?string,
     *   entryName?: ?string,
     *   gateway?: ?string,
     *   batchId?: ?int,
     *   hasVcardTransactions?: ?bool,
     *   isSameDayAch?: ?bool,
     *   scheduleId?: ?int,
     *   settlementStatus?: ?string,
     *   settlementStatusName?: ?string,
     *   settlementDate?: ?string,
     *   riskFlagged?: ?bool,
     *   riskFlaggedOn?: ?string,
     *   riskStatus?: ?string,
     *   riskReason?: ?string,
     *   riskAction?: ?string,
     *   riskActionCode?: ?int,
     *   payoutProgram?: ?string,
     *   achTraceNumber?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->transferDetailId = $values['transferDetailId'] ?? null;
        $this->transferId = $values['transferId'] ?? null;
        $this->transactionId = $values['transactionId'] ?? null;
        $this->idOut = $values['idOut'] ?? null;
        $this->method = $values['method'] ?? null;
        $this->type = $values['type'] ?? null;
        $this->category = $values['category'] ?? null;
        $this->grossAmount = $values['grossAmount'] ?? null;
        $this->returnedAmount = $values['returnedAmount'] ?? null;
        $this->refundAmount = $values['refundAmount'] ?? null;
        $this->holdAmount = $values['holdAmount'] ?? null;
        $this->releasedAmount = $values['releasedAmount'] ?? null;
        $this->billingFeesAmount = $values['billingFeesAmount'] ?? null;
        $this->adjustmentsAmount = $values['adjustmentsAmount'] ?? null;
        $this->netTransferAmount = $values['netTransferAmount'] ?? null;
        $this->billingFeesDetails = $values['billingFeesDetails'] ?? null;
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
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
