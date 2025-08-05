<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Core\Types\ArrayType;
use DateTime;
use Payabli\Core\Types\Date;

class TransferDetailRecord extends JsonSerializableType
{
    /**
     * @var int $transferDetailId Unique identifier for the transfer detail record
     */
    #[JsonProperty('transferDetailId')]
    public int $transferDetailId;

    /**
     * @var int $transferId The ID of the transfer this detail belongs to
     */
    #[JsonProperty('transferId')]
    public int $transferId;

    /**
     * @var string $transactionId The transaction ID in Payabli's system
     */
    #[JsonProperty('transactionId')]
    public string $transactionId;

    /**
     * @var ?string $transactionNumber External transaction reference number
     */
    #[JsonProperty('transactionNumber')]
    public ?string $transactionNumber;

    /**
     * @var int $paypointId The ID of the paypoint this transaction belongs to
     */
    #[JsonProperty('paypointId')]
    public int $paypointId;

    /**
     * @var string $type The transaction type (credit or debit)
     */
    #[JsonProperty('type')]
    public string $type;

    /**
     * @var ?string $category A field used to categorize the transaction details. Values include: auth, decline, refund, adj, cb, split
     */
    #[JsonProperty('category')]
    public ?string $category;

    /**
     * @var float $grossAmount The gross amount of the transaction
     */
    #[JsonProperty('grossAmount')]
    public float $grossAmount;

    /**
     * @var float $chargeBackAmount Chargeback amount deducted from transaction
     */
    #[JsonProperty('chargeBackAmount')]
    public float $chargeBackAmount;

    /**
     * @var float $returnedAmount ACH return amount deducted from transaction
     */
    #[JsonProperty('returnedAmount')]
    public float $returnedAmount;

    /**
     * @var float $refundAmount Refund amount deducted from transaction
     */
    #[JsonProperty('refundAmount')]
    public float $refundAmount;

    /**
     * @var float $holdAmount Amount being held for fraud or risk concerns
     */
    #[JsonProperty('holdAmount')]
    public float $holdAmount;

    /**
     * @var float $releasedAmount Previously held funds that have been released after a risk review
     */
    #[JsonProperty('releasedAmount')]
    public float $releasedAmount;

    /**
     * @var float $billingFeesAmount Charges applied for transactions and services
     */
    #[JsonProperty('billingFeesAmount')]
    public float $billingFeesAmount;

    /**
     * @var float $thirdPartyPaidAmount Payments captured in the batch cycle that are deposited separately. For example,  checks or cash payments recorded in the batch but not deposited via Payabli,  or card brands making a direct transfer in certain situations.
     */
    #[JsonProperty('thirdPartyPaidAmount')]
    public float $thirdPartyPaidAmount;

    /**
     * @var float $adjustmentsAmount Corrections applied to Billing & Fees charges
     */
    #[JsonProperty('adjustmentsAmount')]
    public float $adjustmentsAmount;

    /**
     * @var float $netTransferAmount The net amount after all deductions
     */
    #[JsonProperty('netTransferAmount')]
    public float $netTransferAmount;

    /**
     * @var float $splitFundingAmount Total amount directed to split funding destinations
     */
    #[JsonProperty('splitFundingAmount')]
    public float $splitFundingAmount;

    /**
     * @var ?array<BillingFeeDetail> $billingFeesDetails Detailed breakdown of billing fees applied to the transaction
     */
    #[JsonProperty('billingFeesDetails'), ArrayType([BillingFeeDetail::class])]
    public ?array $billingFeesDetails;

    /**
     * @var ?string $parentOrgName The name of the parent organization
     */
    #[JsonProperty('ParentOrgName')]
    public ?string $parentOrgName;

    /**
     * @var ?string $paypointDbaname The paypoint's DBA name
     */
    #[JsonProperty('PaypointDbaname')]
    public ?string $paypointDbaname;

    /**
     * @var ?string $paypointLegalname The paypoint's legal name
     */
    #[JsonProperty('PaypointLegalname')]
    public ?string $paypointLegalname;

    /**
     * @var ?string $paypointEntryname The paypoint's entryname
     */
    #[JsonProperty('PaypointEntryname')]
    public ?string $paypointEntryname;

    /**
     * @var ?string $paymentTransId The transaction ID for the payment
     */
    #[JsonProperty('PaymentTransId')]
    public ?string $paymentTransId;

    /**
     * @var ?string $connectorName The payment connector used to process the transaction
     */
    #[JsonProperty('ConnectorName')]
    public ?string $connectorName;

    /**
     * @var ?string $externalProcessorInformation Processor information, used for troubleshooting and reporting. This field contains a value when the API key used to make the request has management permissions.
     */
    #[JsonProperty('ExternalProcessorInformation')]
    public ?string $externalProcessorInformation;

    /**
     * @var ?string $gatewayTransId Internal identifier used for processing
     */
    #[JsonProperty('GatewayTransId')]
    public ?string $gatewayTransId;

    /**
     * @var ?string $orderId Custom identifier for the transaction
     */
    #[JsonProperty('OrderId')]
    public ?string $orderId;

    /**
     * @var ?string $method Payment method used: card, ach, or wallet
     */
    #[JsonProperty('Method')]
    public ?string $method;

    /**
     * @var ?string $batchNumber The batch number the transaction was included in
     */
    #[JsonProperty('BatchNumber')]
    public ?string $batchNumber;

    /**
     * @var ?float $batchAmount The amount of the batch
     */
    #[JsonProperty('BatchAmount')]
    public ?float $batchAmount;

    /**
     * @var ?int $payorId Unique ID for customer linked to the transaction
     */
    #[JsonProperty('PayorId')]
    public ?int $payorId;

    /**
     * @var ?QueryPaymentData $paymentData Details about the payment method and transaction
     */
    #[JsonProperty('PaymentData')]
    public ?QueryPaymentData $paymentData;

    /**
     * @var ?int $transStatus Status of transaction. See [the docs](/developers/references/money-in-statuses#money-in-transaction-status) for a full reference.
     */
    #[JsonProperty('TransStatus')]
    public ?int $transStatus;

    /**
     * @var ?float $totalAmount Transaction total amount (including service fee or sub-charge)
     */
    #[JsonProperty('TotalAmount')]
    public ?float $totalAmount;

    /**
     * @var ?float $netAmount Net amount paid
     */
    #[JsonProperty('NetAmount')]
    public ?float $netAmount;

    /**
     * @var ?float $feeAmount Service fee or sub-charge applied
     */
    #[JsonProperty('FeeAmount')]
    public ?float $feeAmount;

    /**
     * @var ?int $settlementStatus Settlement status for transaction. See [the docs](/developers/references/money-in-statuses#payment-funding-status) for a full reference.
     */
    #[JsonProperty('SettlementStatus')]
    public ?int $settlementStatus;

    /**
     * @var ?string $operation The transaction's operation
     */
    #[JsonProperty('Operation')]
    public ?string $operation;

    /**
     * @var ?QueryResponseData $responseData Details about the transaction response
     */
    #[JsonProperty('ResponseData')]
    public ?QueryResponseData $responseData;

    /**
     * @var ?string $source Custom identifier to indicate the transaction or request source
     */
    #[JsonProperty('Source')]
    public ?string $source;

    /**
     * @var ?int $scheduleReference Reference to the subscription or schedule that originated the transaction
     */
    #[JsonProperty('ScheduleReference')]
    public ?int $scheduleReference;

    /**
     * @var ?int $orgId ID of immediate parent organization
     */
    #[JsonProperty('OrgId')]
    public ?int $orgId;

    /**
     * @var ?int $refundId Identifier of refund transaction linked to this payment
     */
    #[JsonProperty('RefundId')]
    public ?int $refundId;

    /**
     * @var ?int $returnedId Identifier of return/chargeback transaction linked to this payment
     */
    #[JsonProperty('ReturnedId')]
    public ?int $returnedId;

    /**
     * @var ?int $chargebackId Identifier of chargeback transaction
     */
    #[JsonProperty('ChargebackId')]
    public ?int $chargebackId;

    /**
     * @var ?int $retrievalId Identifier of retrieval request
     */
    #[JsonProperty('RetrievalId')]
    public ?int $retrievalId;

    /**
     * @var mixed $transAdditionalData Additional transaction data
     */
    #[JsonProperty('TransAdditionalData')]
    public mixed $transAdditionalData;

    /**
     * @var ?BillData $invoiceData Associated invoice data
     */
    #[JsonProperty('invoiceData')]
    public ?BillData $invoiceData;

    /**
     * @var ?int $entrypageId Internal reference ID to the payment page capturing the payment
     */
    #[JsonProperty('EntrypageId')]
    public ?int $entrypageId;

    /**
     * @var ?string $externalPaypointId A custom identifier for the paypoint
     */
    #[JsonProperty('externalPaypointID')]
    public ?string $externalPaypointId;

    /**
     * @var ?DateTime $transactionTime Transaction date and time, in UTC
     */
    #[JsonProperty('TransactionTime'), Date(Date::TYPE_DATETIME)]
    public ?DateTime $transactionTime;

    /**
     * @var ?QueryTransactionPayorData $customer Customer information associated with the transaction
     */
    #[JsonProperty('Customer')]
    public ?QueryTransactionPayorData $customer;

    /**
     * @var ?array<SplitFundingContent> $splitFundingInstructions Split funding instructions for the transaction
     */
    #[JsonProperty('splitFundingInstructions'), ArrayType([SplitFundingContent::class])]
    public ?array $splitFundingInstructions;

    /**
     * @var ?array<QueryCFeeTransaction> $cfeeTransactions Service Fee or sub-charge transactions associated to the main transaction
     */
    #[JsonProperty('CfeeTransactions'), ArrayType([QueryCFeeTransaction::class])]
    public ?array $cfeeTransactions;

    /**
     * @var ?array<QueryTransactionEvents> $transactionEvents Events associated with this transaction
     */
    #[JsonProperty('TransactionEvents'), ArrayType([QueryTransactionEvents::class])]
    public ?array $transactionEvents;

    /**
     * @var ?float $pendingFeeAmount Pending fee amount for the transaction
     */
    #[JsonProperty('PendingFeeAmount')]
    public ?float $pendingFeeAmount;

    /**
     * @var ?bool $riskFlagged Indicates if the transaction was flagged for risk
     */
    #[JsonProperty('RiskFlagged')]
    public ?bool $riskFlagged;

    /**
     * @var ?DateTime $riskFlaggedOn Timestamp when the transaction was flagged for risk
     */
    #[JsonProperty('RiskFlaggedOn'), Date(Date::TYPE_DATETIME)]
    public ?DateTime $riskFlaggedOn;

    /**
     * @var ?string $riskStatus Current risk status of the transaction
     */
    #[JsonProperty('RiskStatus')]
    public ?string $riskStatus;

    /**
     * @var ?string $riskReason Reason for risk flagging
     */
    #[JsonProperty('RiskReason')]
    public ?string $riskReason;

    /**
     * @var ?string $riskAction Action taken due to risk assessment
     */
    #[JsonProperty('RiskAction')]
    public ?string $riskAction;

    /**
     * @var ?int $riskActionCode Numeric code representing the risk action
     */
    #[JsonProperty('RiskActionCode')]
    public ?int $riskActionCode;

    /**
     * @var ?string $deviceId Identifier of registered cloud device used in the transaction
     */
    #[JsonProperty('DeviceId')]
    public ?string $deviceId;

    /**
     * @var ?string $achSecCode Standard Entry Class (SEC) code for ACH transactions
     */
    #[JsonProperty('AchSecCode')]
    public ?string $achSecCode;

    /**
     * @var ?value-of<AchHolderType> $achHolderType Type of ACH account holder (personal or business)
     */
    #[JsonProperty('AchHolderType')]
    public ?string $achHolderType;

    /**
     * @var ?string $ipAddress IP address of the transaction source
     */
    #[JsonProperty('IPAddress')]
    public ?string $ipAddress;

    /**
     * @param array{
     *   transferDetailId: int,
     *   transferId: int,
     *   transactionId: string,
     *   paypointId: int,
     *   type: string,
     *   grossAmount: float,
     *   chargeBackAmount: float,
     *   returnedAmount: float,
     *   refundAmount: float,
     *   holdAmount: float,
     *   releasedAmount: float,
     *   billingFeesAmount: float,
     *   thirdPartyPaidAmount: float,
     *   adjustmentsAmount: float,
     *   netTransferAmount: float,
     *   splitFundingAmount: float,
     *   transactionNumber?: ?string,
     *   category?: ?string,
     *   billingFeesDetails?: ?array<BillingFeeDetail>,
     *   parentOrgName?: ?string,
     *   paypointDbaname?: ?string,
     *   paypointLegalname?: ?string,
     *   paypointEntryname?: ?string,
     *   paymentTransId?: ?string,
     *   connectorName?: ?string,
     *   externalProcessorInformation?: ?string,
     *   gatewayTransId?: ?string,
     *   orderId?: ?string,
     *   method?: ?string,
     *   batchNumber?: ?string,
     *   batchAmount?: ?float,
     *   payorId?: ?int,
     *   paymentData?: ?QueryPaymentData,
     *   transStatus?: ?int,
     *   totalAmount?: ?float,
     *   netAmount?: ?float,
     *   feeAmount?: ?float,
     *   settlementStatus?: ?int,
     *   operation?: ?string,
     *   responseData?: ?QueryResponseData,
     *   source?: ?string,
     *   scheduleReference?: ?int,
     *   orgId?: ?int,
     *   refundId?: ?int,
     *   returnedId?: ?int,
     *   chargebackId?: ?int,
     *   retrievalId?: ?int,
     *   transAdditionalData?: mixed,
     *   invoiceData?: ?BillData,
     *   entrypageId?: ?int,
     *   externalPaypointId?: ?string,
     *   transactionTime?: ?DateTime,
     *   customer?: ?QueryTransactionPayorData,
     *   splitFundingInstructions?: ?array<SplitFundingContent>,
     *   cfeeTransactions?: ?array<QueryCFeeTransaction>,
     *   transactionEvents?: ?array<QueryTransactionEvents>,
     *   pendingFeeAmount?: ?float,
     *   riskFlagged?: ?bool,
     *   riskFlaggedOn?: ?DateTime,
     *   riskStatus?: ?string,
     *   riskReason?: ?string,
     *   riskAction?: ?string,
     *   riskActionCode?: ?int,
     *   deviceId?: ?string,
     *   achSecCode?: ?string,
     *   achHolderType?: ?value-of<AchHolderType>,
     *   ipAddress?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->transferDetailId = $values['transferDetailId'];
        $this->transferId = $values['transferId'];
        $this->transactionId = $values['transactionId'];
        $this->transactionNumber = $values['transactionNumber'] ?? null;
        $this->paypointId = $values['paypointId'];
        $this->type = $values['type'];
        $this->category = $values['category'] ?? null;
        $this->grossAmount = $values['grossAmount'];
        $this->chargeBackAmount = $values['chargeBackAmount'];
        $this->returnedAmount = $values['returnedAmount'];
        $this->refundAmount = $values['refundAmount'];
        $this->holdAmount = $values['holdAmount'];
        $this->releasedAmount = $values['releasedAmount'];
        $this->billingFeesAmount = $values['billingFeesAmount'];
        $this->thirdPartyPaidAmount = $values['thirdPartyPaidAmount'];
        $this->adjustmentsAmount = $values['adjustmentsAmount'];
        $this->netTransferAmount = $values['netTransferAmount'];
        $this->splitFundingAmount = $values['splitFundingAmount'];
        $this->billingFeesDetails = $values['billingFeesDetails'] ?? null;
        $this->parentOrgName = $values['parentOrgName'] ?? null;
        $this->paypointDbaname = $values['paypointDbaname'] ?? null;
        $this->paypointLegalname = $values['paypointLegalname'] ?? null;
        $this->paypointEntryname = $values['paypointEntryname'] ?? null;
        $this->paymentTransId = $values['paymentTransId'] ?? null;
        $this->connectorName = $values['connectorName'] ?? null;
        $this->externalProcessorInformation = $values['externalProcessorInformation'] ?? null;
        $this->gatewayTransId = $values['gatewayTransId'] ?? null;
        $this->orderId = $values['orderId'] ?? null;
        $this->method = $values['method'] ?? null;
        $this->batchNumber = $values['batchNumber'] ?? null;
        $this->batchAmount = $values['batchAmount'] ?? null;
        $this->payorId = $values['payorId'] ?? null;
        $this->paymentData = $values['paymentData'] ?? null;
        $this->transStatus = $values['transStatus'] ?? null;
        $this->totalAmount = $values['totalAmount'] ?? null;
        $this->netAmount = $values['netAmount'] ?? null;
        $this->feeAmount = $values['feeAmount'] ?? null;
        $this->settlementStatus = $values['settlementStatus'] ?? null;
        $this->operation = $values['operation'] ?? null;
        $this->responseData = $values['responseData'] ?? null;
        $this->source = $values['source'] ?? null;
        $this->scheduleReference = $values['scheduleReference'] ?? null;
        $this->orgId = $values['orgId'] ?? null;
        $this->refundId = $values['refundId'] ?? null;
        $this->returnedId = $values['returnedId'] ?? null;
        $this->chargebackId = $values['chargebackId'] ?? null;
        $this->retrievalId = $values['retrievalId'] ?? null;
        $this->transAdditionalData = $values['transAdditionalData'] ?? null;
        $this->invoiceData = $values['invoiceData'] ?? null;
        $this->entrypageId = $values['entrypageId'] ?? null;
        $this->externalPaypointId = $values['externalPaypointId'] ?? null;
        $this->transactionTime = $values['transactionTime'] ?? null;
        $this->customer = $values['customer'] ?? null;
        $this->splitFundingInstructions = $values['splitFundingInstructions'] ?? null;
        $this->cfeeTransactions = $values['cfeeTransactions'] ?? null;
        $this->transactionEvents = $values['transactionEvents'] ?? null;
        $this->pendingFeeAmount = $values['pendingFeeAmount'] ?? null;
        $this->riskFlagged = $values['riskFlagged'] ?? null;
        $this->riskFlaggedOn = $values['riskFlaggedOn'] ?? null;
        $this->riskStatus = $values['riskStatus'] ?? null;
        $this->riskReason = $values['riskReason'] ?? null;
        $this->riskAction = $values['riskAction'] ?? null;
        $this->riskActionCode = $values['riskActionCode'] ?? null;
        $this->deviceId = $values['deviceId'] ?? null;
        $this->achSecCode = $values['achSecCode'] ?? null;
        $this->achHolderType = $values['achHolderType'] ?? null;
        $this->ipAddress = $values['ipAddress'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
