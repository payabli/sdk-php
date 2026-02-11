<?php

namespace Payabli\QueryTypes\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * Payment data for an outbound transfer detail.
 */
class TransferOutDetailPaymentData extends JsonSerializableType
{
    /**
     * @var ?string $maskedAccount Masked account number.
     */
    #[JsonProperty('MaskedAccount')]
    public ?string $maskedAccount;

    /**
     * @var ?string $accountType Type of account.
     */
    #[JsonProperty('AccountType')]
    public ?string $accountType;

    /**
     * @var ?string $accountExp Account expiration date.
     */
    #[JsonProperty('AccountExp')]
    public ?string $accountExp;

    /**
     * @var ?string $accountZip ZIP code associated with the account.
     */
    #[JsonProperty('AccountZip')]
    public ?string $accountZip;

    /**
     * @var ?string $holderName Name of the account holder.
     */
    #[JsonProperty('HolderName')]
    public ?string $holderName;

    /**
     * @var ?string $storedId ID of the stored payment method.
     */
    #[JsonProperty('StoredId')]
    public ?string $storedId;

    /**
     * @var ?string $initiator Initiator of the payment.
     */
    #[JsonProperty('Initiator')]
    public ?string $initiator;

    /**
     * @var ?string $storedMethodUsageType Usage type for stored method.
     */
    #[JsonProperty('StoredMethodUsageType')]
    public ?string $storedMethodUsageType;

    /**
     * @var ?string $sequence Sequence number.
     */
    #[JsonProperty('Sequence')]
    public ?string $sequence;

    /**
     * @var ?string $orderDescription Description of the order.
     */
    #[JsonProperty('orderDescription')]
    public ?string $orderDescription;

    /**
     * @var ?string $cloudSignatureData Cloud signature data.
     */
    #[JsonProperty('cloudSignatureData')]
    public ?string $cloudSignatureData;

    /**
     * @var ?string $cloudSignatureFormat Format of cloud signature.
     */
    #[JsonProperty('cloudSignatureFormat')]
    public ?string $cloudSignatureFormat;

    /**
     * @var mixed $paymentDetails Additional payment details.
     */
    #[JsonProperty('paymentDetails')]
    public mixed $paymentDetails;

    /**
     * @var ?string $payorData Data about the payor.
     */
    #[JsonProperty('payorData')]
    public ?string $payorData;

    /**
     * @var ?string $accountId Account ID.
     */
    #[JsonProperty('accountId')]
    public ?string $accountId;

    /**
     * @var ?string $bankAccount Bank account information.
     */
    #[JsonProperty('bankAccount')]
    public ?string $bankAccount;

    /**
     * @var ?string $gatewayConnector Gateway connector used.
     */
    #[JsonProperty('gatewayConnector')]
    public ?string $gatewayConnector;

    /**
     * @var mixed $binData BIN data for the card.
     */
    #[JsonProperty('binData')]
    public mixed $binData;

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
     *   paymentDetails?: mixed,
     *   payorData?: ?string,
     *   accountId?: ?string,
     *   bankAccount?: ?string,
     *   gatewayConnector?: ?string,
     *   binData?: mixed,
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
