<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use DateTime;
use Payabli\Core\Types\Date;
use Payabli\Core\Types\ArrayType;

class ChargebackQueryRecords extends JsonSerializableType
{
    /**
     * @var ?string $accountType
     */
    #[JsonProperty('accountType')]
    public ?string $accountType;

    /**
     * @var ?string $caseNumber Number of case assigned to the chargeback.
     */
    #[JsonProperty('caseNumber')]
    public ?string $caseNumber;

    /**
     * @var ?DateTime $chargebackDate Date of chargeback in format YYYY-MM-DD or MM/DD/YYYY.
     */
    #[JsonProperty('chargebackDate'), Date(Date::TYPE_DATETIME)]
    public ?DateTime $chargebackDate;

    /**
     * @var ?DateTime $createdAt Timestamp when the register was created, in UTC.
     */
    #[JsonProperty('createdAt'), Date(Date::TYPE_DATETIME)]
    public ?DateTime $createdAt;

    /**
     * @var ?QueryTransactionPayorData $customer
     */
    #[JsonProperty('customer')]
    public ?QueryTransactionPayorData $customer;

    /**
     * @var ?int $id Identifier of chargeback or return.
     */
    #[JsonProperty('id')]
    public ?int $id;

    /**
     * @var string $lastFour Last 4 digits of card or bank account involved in chargeback or return.
     */
    #[JsonProperty('lastFour')]
    public string $lastFour;

    /**
     * @var string $method Type of payment vehicle: **ach** or **card**.
     */
    #[JsonProperty('method')]
    public string $method;

    /**
     * @var ?float $netAmount Net amount in chargeback or ACH return.
     */
    #[JsonProperty('netAmount')]
    public ?float $netAmount;

    /**
     * @var ?string $orderId
     */
    #[JsonProperty('orderId')]
    public ?string $orderId;

    /**
     * @var ?string $parentOrgName
     */
    #[JsonProperty('parentOrgName')]
    public ?string $parentOrgName;

    /**
     * @var ?QueryPaymentData $paymentData
     */
    #[JsonProperty('paymentData')]
    public ?QueryPaymentData $paymentData;

    /**
     * @var ?string $paymentId ReferenceId of the transaction in Payabli.
     */
    #[JsonProperty('PaymentId')]
    public ?string $paymentId;

    /**
     * @var ?string $paypointDbaname The paypoint's DBA name.
     */
    #[JsonProperty('paypointDbaname')]
    public ?string $paypointDbaname;

    /**
     * @var ?string $paypointEntryname The paypoint's entryname.
     */
    #[JsonProperty('paypointEntryname')]
    public ?string $paypointEntryname;

    /**
     * @var ?string $paypointLegalname The paypoint's legal name.
     */
    #[JsonProperty('paypointLegalname')]
    public ?string $paypointLegalname;

    /**
     * @var ?string $reason Text describing the chargeback or ACH return reason.
     */
    #[JsonProperty('reason')]
    public ?string $reason;

    /**
     * @var ?string $reasonCode R code for returned ACH or custom code identifying the reason.
     */
    #[JsonProperty('reasonCode')]
    public ?string $reasonCode;

    /**
     * @var ?string $referenceNumber Processor reference number to the chargeback.
     */
    #[JsonProperty('referenceNumber')]
    public ?string $referenceNumber;

    /**
     * @var ?array<ChargeBackResponse> $responses Chargeback response records.
     */
    #[JsonProperty('responses'), ArrayType([ChargeBackResponse::class])]
    public ?array $responses;

    /**
     * Status for chargeback or ACH return
     *
     * - 0: Open (chargebacks only)
     * - 1: Pending (chargebacks only)
     * - 2: Closed-Won (chargebacks only)
     * - 3: Closed-Lost (chargebacks only)
     * - 4: ACH Return (ACH only)
     * - 5: ACH Dispute, Not Authorized (ACH only)
     *
     * @var ?int $status
     */
    #[JsonProperty('status')]
    public ?int $status;

    /**
     * @var ?TransactionQueryRecords $transaction
     */
    #[JsonProperty('transaction')]
    public ?TransactionQueryRecords $transaction;

    /**
     * @var ?DateTime $transactionTime
     */
    #[JsonProperty('transactionTime'), Date(Date::TYPE_DATETIME)]
    public ?DateTime $transactionTime;

    /**
     * @param array{
     *   lastFour: string,
     *   method: string,
     *   accountType?: ?string,
     *   caseNumber?: ?string,
     *   chargebackDate?: ?DateTime,
     *   createdAt?: ?DateTime,
     *   customer?: ?QueryTransactionPayorData,
     *   id?: ?int,
     *   netAmount?: ?float,
     *   orderId?: ?string,
     *   parentOrgName?: ?string,
     *   paymentData?: ?QueryPaymentData,
     *   paymentId?: ?string,
     *   paypointDbaname?: ?string,
     *   paypointEntryname?: ?string,
     *   paypointLegalname?: ?string,
     *   reason?: ?string,
     *   reasonCode?: ?string,
     *   referenceNumber?: ?string,
     *   responses?: ?array<ChargeBackResponse>,
     *   status?: ?int,
     *   transaction?: ?TransactionQueryRecords,
     *   transactionTime?: ?DateTime,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->accountType = $values['accountType'] ?? null;
        $this->caseNumber = $values['caseNumber'] ?? null;
        $this->chargebackDate = $values['chargebackDate'] ?? null;
        $this->createdAt = $values['createdAt'] ?? null;
        $this->customer = $values['customer'] ?? null;
        $this->id = $values['id'] ?? null;
        $this->lastFour = $values['lastFour'];
        $this->method = $values['method'];
        $this->netAmount = $values['netAmount'] ?? null;
        $this->orderId = $values['orderId'] ?? null;
        $this->parentOrgName = $values['parentOrgName'] ?? null;
        $this->paymentData = $values['paymentData'] ?? null;
        $this->paymentId = $values['paymentId'] ?? null;
        $this->paypointDbaname = $values['paypointDbaname'] ?? null;
        $this->paypointEntryname = $values['paypointEntryname'] ?? null;
        $this->paypointLegalname = $values['paypointLegalname'] ?? null;
        $this->reason = $values['reason'] ?? null;
        $this->reasonCode = $values['reasonCode'] ?? null;
        $this->referenceNumber = $values['referenceNumber'] ?? null;
        $this->responses = $values['responses'] ?? null;
        $this->status = $values['status'] ?? null;
        $this->transaction = $values['transaction'] ?? null;
        $this->transactionTime = $values['transactionTime'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
