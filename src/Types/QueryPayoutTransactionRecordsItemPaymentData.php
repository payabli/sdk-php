<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

class QueryPayoutTransactionRecordsItemPaymentData extends JsonSerializableType
{
    /**
     * @var ?string $accountExp
     */
    #[JsonProperty('AccountExp')]
    public ?string $accountExp;

    /**
     * @var ?string $accountId
     */
    #[JsonProperty('accountId')]
    public ?string $accountId;

    /**
     * @var ?string $accountType
     */
    #[JsonProperty('AccountType')]
    public ?string $accountType;

    /**
     * @var ?string $accountZip
     */
    #[JsonProperty('AccountZip')]
    public ?string $accountZip;

    /**
     * @var ?string $bankAccount
     */
    #[JsonProperty('bankAccount')]
    public ?string $bankAccount;

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
     * @var ?string $holderName Card or bank account holder name.
     */
    #[JsonProperty('HolderName')]
    public ?string $holderName;

    /**
     * @var ?string $maskedAccount
     */
    #[JsonProperty('MaskedAccount')]
    public ?string $maskedAccount;

    /**
     * @var ?string $orderDescription
     */
    #[JsonProperty('orderDescription')]
    public ?string $orderDescription;

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
     * @var ?string $storedId Identifier of stored payment method used in transaction.
     */
    #[JsonProperty('StoredId')]
    public ?string $storedId;

    /**
     * @param array{
     *   accountExp?: ?string,
     *   accountId?: ?string,
     *   accountType?: ?string,
     *   accountZip?: ?string,
     *   bankAccount?: ?string,
     *   cloudSignatureData?: ?string,
     *   cloudSignatureFormat?: ?string,
     *   holderName?: ?string,
     *   maskedAccount?: ?string,
     *   orderDescription?: ?string,
     *   paymentDetails?: ?PaymentDetail,
     *   payorData?: ?string,
     *   storedId?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->accountExp = $values['accountExp'] ?? null;
        $this->accountId = $values['accountId'] ?? null;
        $this->accountType = $values['accountType'] ?? null;
        $this->accountZip = $values['accountZip'] ?? null;
        $this->bankAccount = $values['bankAccount'] ?? null;
        $this->cloudSignatureData = $values['cloudSignatureData'] ?? null;
        $this->cloudSignatureFormat = $values['cloudSignatureFormat'] ?? null;
        $this->holderName = $values['holderName'] ?? null;
        $this->maskedAccount = $values['maskedAccount'] ?? null;
        $this->orderDescription = $values['orderDescription'] ?? null;
        $this->paymentDetails = $values['paymentDetails'] ?? null;
        $this->payorData = $values['payorData'] ?? null;
        $this->storedId = $values['storedId'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
