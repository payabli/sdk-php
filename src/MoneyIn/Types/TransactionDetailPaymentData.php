<?php

namespace Payabli\MoneyIn\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Types\BinData;

/**
 * Payment method and transaction details
 */
class TransactionDetailPaymentData extends JsonSerializableType
{
    /**
     * @var string $maskedAccount
     */
    #[JsonProperty('maskedAccount')]
    public string $maskedAccount;

    /**
     * @var string $accountType
     */
    #[JsonProperty('accountType')]
    public string $accountType;

    /**
     * @var ?string $accountExp
     */
    #[JsonProperty('accountExp')]
    public ?string $accountExp;

    /**
     * @var string $holderName
     */
    #[JsonProperty('holderName')]
    public string $holderName;

    /**
     * @var ?string $storedId
     */
    #[JsonProperty('storedId')]
    public ?string $storedId;

    /**
     * @var ?string $initiator
     */
    #[JsonProperty('initiator')]
    public ?string $initiator;

    /**
     * @var ?string $storedMethodUsageType
     */
    #[JsonProperty('storedMethodUsageType')]
    public ?string $storedMethodUsageType;

    /**
     * @var ?string $sequence
     */
    #[JsonProperty('sequence')]
    public ?string $sequence;

    /**
     * @var string $orderDescription
     */
    #[JsonProperty('orderDescription')]
    public string $orderDescription;

    /**
     * @var ?string $accountId
     */
    #[JsonProperty('accountId')]
    public ?string $accountId;

    /**
     * @var ?string $signatureData
     */
    #[JsonProperty('signatureData')]
    public ?string $signatureData;

    /**
     * @var ?BinData $binData
     */
    #[JsonProperty('binData')]
    public ?BinData $binData;

    /**
     * @var TransactionDetailPaymentDetails $paymentDetails
     */
    #[JsonProperty('paymentDetails')]
    public TransactionDetailPaymentDetails $paymentDetails;

    /**
     * @param array{
     *   maskedAccount: string,
     *   accountType: string,
     *   holderName: string,
     *   orderDescription: string,
     *   paymentDetails: TransactionDetailPaymentDetails,
     *   accountExp?: ?string,
     *   storedId?: ?string,
     *   initiator?: ?string,
     *   storedMethodUsageType?: ?string,
     *   sequence?: ?string,
     *   accountId?: ?string,
     *   signatureData?: ?string,
     *   binData?: ?BinData,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->maskedAccount = $values['maskedAccount'];
        $this->accountType = $values['accountType'];
        $this->accountExp = $values['accountExp'] ?? null;
        $this->holderName = $values['holderName'];
        $this->storedId = $values['storedId'] ?? null;
        $this->initiator = $values['initiator'] ?? null;
        $this->storedMethodUsageType = $values['storedMethodUsageType'] ?? null;
        $this->sequence = $values['sequence'] ?? null;
        $this->orderDescription = $values['orderDescription'];
        $this->accountId = $values['accountId'] ?? null;
        $this->signatureData = $values['signatureData'] ?? null;
        $this->binData = $values['binData'] ?? null;
        $this->paymentDetails = $values['paymentDetails'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
