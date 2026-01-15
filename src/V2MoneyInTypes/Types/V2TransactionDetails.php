<?php

namespace Payabli\V2MoneyInTypes\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\MoneyIn\Types\TransactionDetailPaymentData;
use Payabli\MoneyIn\Types\TransactionDetailInvoiceData;
use Payabli\MoneyIn\Types\TransactionDetailCustomer;
use Payabli\Types\SplitFundingContent;
use Payabli\Core\Types\ArrayType;
use Payabli\Types\QueryCFeeTransaction;
use Payabli\MoneyIn\Types\TransactionDetailEvent;
use DateTime;
use Payabli\Core\Types\Date;
use Payabli\Types\AchHolderType;

/**
 * Complete transaction details returned by v2 Money In endpoints. This matches the structure of the transaction details previously returned by the v1 details endpoint.
 */
class V2TransactionDetails extends JsonSerializableType
{
    /**
     * @var string $parentOrgName
     */
    #[JsonProperty('parentOrgName')]
    public string $parentOrgName;

    /**
     * @var string $paypointDbaname
     */
    #[JsonProperty('paypointDbaname')]
    public string $paypointDbaname;

    /**
     * @var string $paypointLegalname
     */
    #[JsonProperty('paypointLegalname')]
    public string $paypointLegalname;

    /**
     * @var string $paypointEntryname
     */
    #[JsonProperty('paypointEntryname')]
    public string $paypointEntryname;

    /**
     * @var string $paymentTransId Unique transaction identifier.
     */
    #[JsonProperty('paymentTransId')]
    public string $paymentTransId;

    /**
     * @var string $connectorName Name of the payment connector used.
     */
    #[JsonProperty('connectorName')]
    public string $connectorName;

    /**
     * @var string $externalProcessorInformation
     */
    #[JsonProperty('externalProcessorInformation')]
    public string $externalProcessorInformation;

    /**
     * @var string $gatewayTransId Gateway transaction identifier.
     */
    #[JsonProperty('gatewayTransId')]
    public string $gatewayTransId;

    /**
     * @var ?string $orderId
     */
    #[JsonProperty('orderId')]
    public ?string $orderId;

    /**
     * @var string $method Payment method used for the transaction.
     */
    #[JsonProperty('method')]
    public string $method;

    /**
     * @var string $batchNumber
     */
    #[JsonProperty('batchNumber')]
    public string $batchNumber;

    /**
     * @var float $batchAmount Total amount in the batch.
     */
    #[JsonProperty('batchAmount')]
    public float $batchAmount;

    /**
     * @var int $payorId
     */
    #[JsonProperty('payorId')]
    public int $payorId;

    /**
     * @var TransactionDetailPaymentData $paymentData
     */
    #[JsonProperty('paymentData')]
    public TransactionDetailPaymentData $paymentData;

    /**
     * @var int $transStatus
     */
    #[JsonProperty('transStatus')]
    public int $transStatus;

    /**
     * @var int $paypointId
     */
    #[JsonProperty('paypointId')]
    public int $paypointId;

    /**
     * @var float $totalAmount Total transaction amount including fees.
     */
    #[JsonProperty('totalAmount')]
    public float $totalAmount;

    /**
     * @var float $netAmount Net transaction amount excluding fees.
     */
    #[JsonProperty('netAmount')]
    public float $netAmount;

    /**
     * @var float $feeAmount
     */
    #[JsonProperty('feeAmount')]
    public float $feeAmount;

    /**
     * @var int $settlementStatus
     */
    #[JsonProperty('settlementStatus')]
    public int $settlementStatus;

    /**
     * @var string $operation
     */
    #[JsonProperty('operation')]
    public string $operation;

    /**
     * @var V2TransactionDetailResponseData $responseData
     */
    #[JsonProperty('responseData')]
    public V2TransactionDetailResponseData $responseData;

    /**
     * @var string $source
     */
    #[JsonProperty('source')]
    public string $source;

    /**
     * @var int $scheduleReference Reference to associated payment schedule if applicable.
     */
    #[JsonProperty('scheduleReference')]
    public int $scheduleReference;

    /**
     * @var int $orgId
     */
    #[JsonProperty('orgId')]
    public int $orgId;

    /**
     * @var int $refundId
     */
    #[JsonProperty('refundId')]
    public int $refundId;

    /**
     * @var int $returnedId
     */
    #[JsonProperty('returnedId')]
    public int $returnedId;

    /**
     * @var int $chargebackId
     */
    #[JsonProperty('chargebackId')]
    public int $chargebackId;

    /**
     * @var int $retrievalId
     */
    #[JsonProperty('retrievalId')]
    public int $retrievalId;

    /**
     * @var mixed $transAdditionalData
     */
    #[JsonProperty('transAdditionalData')]
    public mixed $transAdditionalData;

    /**
     * @var TransactionDetailInvoiceData $invoiceData
     */
    #[JsonProperty('invoiceData')]
    public TransactionDetailInvoiceData $invoiceData;

    /**
     * @var int $entrypageId
     */
    #[JsonProperty('entrypageId')]
    public int $entrypageId;

    /**
     * @var string $externalPaypointId
     */
    #[JsonProperty('externalPaypointID')]
    public string $externalPaypointId;

    /**
     * @var bool $isValidatedAch Indicates if ACH account was validated in real-time.
     */
    #[JsonProperty('isValidatedACH')]
    public bool $isValidatedAch;

    /**
     * @var string $transactionTime Timestamp when transaction was created.
     */
    #[JsonProperty('transactionTime')]
    public string $transactionTime;

    /**
     * @var TransactionDetailCustomer $customer
     */
    #[JsonProperty('customer')]
    public TransactionDetailCustomer $customer;

    /**
     * @var ?array<SplitFundingContent> $splitFundingInstructions
     */
    #[JsonProperty('splitFundingInstructions'), ArrayType([SplitFundingContent::class])]
    public ?array $splitFundingInstructions;

    /**
     * @var array<QueryCFeeTransaction> $cfeeTransactions
     */
    #[JsonProperty('cfeeTransactions'), ArrayType([QueryCFeeTransaction::class])]
    public array $cfeeTransactions;

    /**
     * @var array<TransactionDetailEvent> $transactionEvents
     */
    #[JsonProperty('transactionEvents'), ArrayType([TransactionDetailEvent::class])]
    public array $transactionEvents;

    /**
     * @var ?float $pendingFeeAmount
     */
    #[JsonProperty('pendingFeeAmount')]
    public ?float $pendingFeeAmount;

    /**
     * @var ?bool $riskFlagged
     */
    #[JsonProperty('riskFlagged')]
    public ?bool $riskFlagged;

    /**
     * @var ?DateTime $riskFlaggedOn
     */
    #[JsonProperty('riskFlaggedOn'), Date(Date::TYPE_DATETIME)]
    public ?DateTime $riskFlaggedOn;

    /**
     * @var string $riskStatus
     */
    #[JsonProperty('riskStatus')]
    public string $riskStatus;

    /**
     * @var string $riskReason
     */
    #[JsonProperty('riskReason')]
    public string $riskReason;

    /**
     * @var string $riskAction
     */
    #[JsonProperty('riskAction')]
    public string $riskAction;

    /**
     * @var ?int $riskActionCode
     */
    #[JsonProperty('riskActionCode')]
    public ?int $riskActionCode;

    /**
     * @var string $deviceId
     */
    #[JsonProperty('deviceId')]
    public string $deviceId;

    /**
     * @var string $achSecCode
     */
    #[JsonProperty('achSecCode')]
    public string $achSecCode;

    /**
     * @var value-of<AchHolderType> $achHolderType
     */
    #[JsonProperty('achHolderType')]
    public string $achHolderType;

    /**
     * @var string $ipAddress
     */
    #[JsonProperty('ipAddress')]
    public string $ipAddress;

    /**
     * @var bool $isSameDayAch Indicates if ACH transaction uses same-day processing.
     */
    #[JsonProperty('isSameDayACH')]
    public bool $isSameDayAch;

    /**
     * @var ?string $walletType Digital wallet type if applicable.
     */
    #[JsonProperty('walletType')]
    public ?string $walletType;

    /**
     * @param array{
     *   parentOrgName: string,
     *   paypointDbaname: string,
     *   paypointLegalname: string,
     *   paypointEntryname: string,
     *   paymentTransId: string,
     *   connectorName: string,
     *   externalProcessorInformation: string,
     *   gatewayTransId: string,
     *   method: string,
     *   batchNumber: string,
     *   batchAmount: float,
     *   payorId: int,
     *   paymentData: TransactionDetailPaymentData,
     *   transStatus: int,
     *   paypointId: int,
     *   totalAmount: float,
     *   netAmount: float,
     *   feeAmount: float,
     *   settlementStatus: int,
     *   operation: string,
     *   responseData: V2TransactionDetailResponseData,
     *   source: string,
     *   scheduleReference: int,
     *   orgId: int,
     *   refundId: int,
     *   returnedId: int,
     *   chargebackId: int,
     *   retrievalId: int,
     *   invoiceData: TransactionDetailInvoiceData,
     *   entrypageId: int,
     *   externalPaypointId: string,
     *   isValidatedAch: bool,
     *   transactionTime: string,
     *   customer: TransactionDetailCustomer,
     *   cfeeTransactions: array<QueryCFeeTransaction>,
     *   transactionEvents: array<TransactionDetailEvent>,
     *   riskStatus: string,
     *   riskReason: string,
     *   riskAction: string,
     *   deviceId: string,
     *   achSecCode: string,
     *   achHolderType: value-of<AchHolderType>,
     *   ipAddress: string,
     *   isSameDayAch: bool,
     *   orderId?: ?string,
     *   transAdditionalData?: mixed,
     *   splitFundingInstructions?: ?array<SplitFundingContent>,
     *   pendingFeeAmount?: ?float,
     *   riskFlagged?: ?bool,
     *   riskFlaggedOn?: ?DateTime,
     *   riskActionCode?: ?int,
     *   walletType?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->parentOrgName = $values['parentOrgName'];
        $this->paypointDbaname = $values['paypointDbaname'];
        $this->paypointLegalname = $values['paypointLegalname'];
        $this->paypointEntryname = $values['paypointEntryname'];
        $this->paymentTransId = $values['paymentTransId'];
        $this->connectorName = $values['connectorName'];
        $this->externalProcessorInformation = $values['externalProcessorInformation'];
        $this->gatewayTransId = $values['gatewayTransId'];
        $this->orderId = $values['orderId'] ?? null;
        $this->method = $values['method'];
        $this->batchNumber = $values['batchNumber'];
        $this->batchAmount = $values['batchAmount'];
        $this->payorId = $values['payorId'];
        $this->paymentData = $values['paymentData'];
        $this->transStatus = $values['transStatus'];
        $this->paypointId = $values['paypointId'];
        $this->totalAmount = $values['totalAmount'];
        $this->netAmount = $values['netAmount'];
        $this->feeAmount = $values['feeAmount'];
        $this->settlementStatus = $values['settlementStatus'];
        $this->operation = $values['operation'];
        $this->responseData = $values['responseData'];
        $this->source = $values['source'];
        $this->scheduleReference = $values['scheduleReference'];
        $this->orgId = $values['orgId'];
        $this->refundId = $values['refundId'];
        $this->returnedId = $values['returnedId'];
        $this->chargebackId = $values['chargebackId'];
        $this->retrievalId = $values['retrievalId'];
        $this->transAdditionalData = $values['transAdditionalData'] ?? null;
        $this->invoiceData = $values['invoiceData'];
        $this->entrypageId = $values['entrypageId'];
        $this->externalPaypointId = $values['externalPaypointId'];
        $this->isValidatedAch = $values['isValidatedAch'];
        $this->transactionTime = $values['transactionTime'];
        $this->customer = $values['customer'];
        $this->splitFundingInstructions = $values['splitFundingInstructions'] ?? null;
        $this->cfeeTransactions = $values['cfeeTransactions'];
        $this->transactionEvents = $values['transactionEvents'];
        $this->pendingFeeAmount = $values['pendingFeeAmount'] ?? null;
        $this->riskFlagged = $values['riskFlagged'] ?? null;
        $this->riskFlaggedOn = $values['riskFlaggedOn'] ?? null;
        $this->riskStatus = $values['riskStatus'];
        $this->riskReason = $values['riskReason'];
        $this->riskAction = $values['riskAction'];
        $this->riskActionCode = $values['riskActionCode'] ?? null;
        $this->deviceId = $values['deviceId'];
        $this->achSecCode = $values['achSecCode'];
        $this->achHolderType = $values['achHolderType'];
        $this->ipAddress = $values['ipAddress'];
        $this->isSameDayAch = $values['isSameDayAch'];
        $this->walletType = $values['walletType'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
