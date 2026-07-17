<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

class QueryPayoutTransactionRecordsItemPaymentData extends JsonSerializableType
{
    /**
     * @var ?string $maskedAccount
     */
    #[JsonProperty('MaskedAccount')]
    public ?string $maskedAccount;

    /**
     * @var ?string $accountType
     */
    #[JsonProperty('AccountType')]
    public ?string $accountType;

    /**
     * @var ?string $accountExp
     */
    #[JsonProperty('AccountExp')]
    public ?string $accountExp;

    /**
     * @var ?string $accountZip
     */
    #[JsonProperty('AccountZip')]
    public ?string $accountZip;

    /**
     * @var ?string $holderName Card or bank account holder name.
     */
    #[JsonProperty('HolderName')]
    public ?string $holderName;

    /**
     * @var ?string $storedId Identifier of stored payment method used in transaction.
     */
    #[JsonProperty('StoredId')]
    public ?string $storedId;

    /**
     * @var ?string $initiator
     */
    #[JsonProperty('Initiator')]
    public ?string $initiator;

    /**
     * @var ?string $storedMethodUsageType
     */
    #[JsonProperty('StoredMethodUsageType')]
    public ?string $storedMethodUsageType;

    /**
     * @var ?string $sequence
     */
    #[JsonProperty('Sequence')]
    public ?string $sequence;

    /**
     * @var ?string $orderDescription
     */
    #[JsonProperty('orderDescription')]
    public ?string $orderDescription;

    /**
     * @var ?string $cloudSignatureData
     */
    #[JsonProperty('cloudSignatureData')]
    public ?string $cloudSignatureData;

    /**
     * @var ?string $cloudSignatureFormat
     */
    #[JsonProperty('cloudSignatureFormat')]
    public ?string $cloudSignatureFormat;

    /**
     * @var ?PaymentDetail $paymentDetails
     */
    #[JsonProperty('paymentDetails')]
    public ?PaymentDetail $paymentDetails;

    /**
     * @var ?string $payorData
     */
    #[JsonProperty('payorData')]
    public ?string $payorData;

    /**
     * @var ?string $accountId
     */
    #[JsonProperty('accountId')]
    public ?string $accountId;

    /**
     * @var ?string $bankAccount
     */
    #[JsonProperty('bankAccount')]
    public ?string $bankAccount;

    /**
     * @var ?PayoutGatewayConnector $gatewayConnector
     */
    #[JsonProperty('gatewayConnector')]
    public ?PayoutGatewayConnector $gatewayConnector;

    /**
     * @var ?BinData $binData
     */
    #[JsonProperty('binData')]
    public ?BinData $binData;

    /**
     * @param array{
     *   maskedAccount?: ?string,
     *   accountType?: ?string,
     *   accountExp?: ?string,
     *   accountZip?: ?string,
     *   holderName?: ?string,
     *   storedId?: ?string,
     *   initiator?: ?string,
     *   storedMethodUsageType?: ?string,
     *   sequence?: ?string,
     *   orderDescription?: ?string,
     *   cloudSignatureData?: ?string,
     *   cloudSignatureFormat?: ?string,
     *   paymentDetails?: ?PaymentDetail,
     *   payorData?: ?string,
     *   accountId?: ?string,
     *   bankAccount?: ?string,
     *   gatewayConnector?: ?PayoutGatewayConnector,
     *   binData?: ?BinData,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->maskedAccount = $values['maskedAccount'] ?? null;
        $this->accountType = $values['accountType'] ?? null;
        $this->accountExp = $values['accountExp'] ?? null;
        $this->accountZip = $values['accountZip'] ?? null;
        $this->holderName = $values['holderName'] ?? null;
        $this->storedId = $values['storedId'] ?? null;
        $this->initiator = $values['initiator'] ?? null;
        $this->storedMethodUsageType = $values['storedMethodUsageType'] ?? null;
        $this->sequence = $values['sequence'] ?? null;
        $this->orderDescription = $values['orderDescription'] ?? null;
        $this->cloudSignatureData = $values['cloudSignatureData'] ?? null;
        $this->cloudSignatureFormat = $values['cloudSignatureFormat'] ?? null;
        $this->paymentDetails = $values['paymentDetails'] ?? null;
        $this->payorData = $values['payorData'] ?? null;
        $this->accountId = $values['accountId'] ?? null;
        $this->bankAccount = $values['bankAccount'] ?? null;
        $this->gatewayConnector = $values['gatewayConnector'] ?? null;
        $this->binData = $values['binData'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
