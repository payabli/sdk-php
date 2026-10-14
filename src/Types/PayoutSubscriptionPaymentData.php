<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * Payment method details for the payout subscription.
 */
class PayoutSubscriptionPaymentData extends JsonSerializableType
{
    /**
     * @var ?string $accountExp
     */
    #[JsonProperty('accountExp')]
    public ?string $accountExp;

    /**
     * @var ?string $accountId
     */
    #[JsonProperty('accountId')]
    public ?string $accountId;

    /**
     * @var ?string $accountType
     */
    #[JsonProperty('accountType')]
    public ?string $accountType;

    /**
     * @var ?string $accountZip
     */
    #[JsonProperty('accountZip')]
    public ?string $accountZip;

    /**
     * @var ?BinData $binData Card information. Always `null` on this endpoint.
     */
    #[JsonProperty('binData')]
    public ?BinData $binData;

    /**
     * @var ?string $holderName
     */
    #[JsonProperty('holderName')]
    public ?string $holderName;

    /**
     * @var ?string $initiator The transaction's initiator. Always `null` on this endpoint.
     */
    #[JsonProperty('initiator')]
    public ?string $initiator;

    /**
     * @var ?string $maskedAccount
     */
    #[JsonProperty('maskedAccount')]
    public ?string $maskedAccount;

    /**
     * @var ?string $orderDescription
     */
    #[JsonProperty('orderDescription')]
    public ?string $orderDescription;

    /**
     * @var ?PayoutSubscriptionPaymentDetails $paymentDetails
     */
    #[JsonProperty('paymentDetails')]
    public ?PayoutSubscriptionPaymentDetails $paymentDetails;

    /**
     * @var ?PayoutSubscriptionPaymentDataPayorSignature $payorSignature Signature captured on a card-present device. Always `null` for payout subscriptions.
     */
    #[JsonProperty('payorSignature')]
    public ?PayoutSubscriptionPaymentDataPayorSignature $payorSignature;

    /**
     * @var ?string $sequence The order of the transaction for cardholder-initiated and merchant-initiated transaction purposes. Always `null` on this endpoint.
     */
    #[JsonProperty('sequence')]
    public ?string $sequence;

    /**
     * @var ?string $signatureData
     */
    #[JsonProperty('signatureData')]
    public ?string $signatureData;

    /**
     * @var ?string $walletType Digital wallet type if applicable. Always `null` on this endpoint.
     */
    #[JsonProperty('walletType')]
    public ?string $walletType;

    /**
     * @var ?string $storedId Identifier of stored payment method used in transaction.
     */
    #[JsonProperty('storedId')]
    public ?string $storedId;

    /**
     * @var ?string $storedMethodUsageType The usage type for the stored method. Always `null` on this endpoint.
     */
    #[JsonProperty('storedMethodUsageType')]
    public ?string $storedMethodUsageType;

    /**
     * @param array{
     *   accountExp?: ?string,
     *   accountId?: ?string,
     *   accountType?: ?string,
     *   accountZip?: ?string,
     *   binData?: ?BinData,
     *   holderName?: ?string,
     *   initiator?: ?string,
     *   maskedAccount?: ?string,
     *   orderDescription?: ?string,
     *   paymentDetails?: ?PayoutSubscriptionPaymentDetails,
     *   payorSignature?: ?PayoutSubscriptionPaymentDataPayorSignature,
     *   sequence?: ?string,
     *   signatureData?: ?string,
     *   walletType?: ?string,
     *   storedId?: ?string,
     *   storedMethodUsageType?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->accountExp = $values['accountExp'] ?? null;
        $this->accountId = $values['accountId'] ?? null;
        $this->accountType = $values['accountType'] ?? null;
        $this->accountZip = $values['accountZip'] ?? null;
        $this->binData = $values['binData'] ?? null;
        $this->holderName = $values['holderName'] ?? null;
        $this->initiator = $values['initiator'] ?? null;
        $this->maskedAccount = $values['maskedAccount'] ?? null;
        $this->orderDescription = $values['orderDescription'] ?? null;
        $this->paymentDetails = $values['paymentDetails'] ?? null;
        $this->payorSignature = $values['payorSignature'] ?? null;
        $this->sequence = $values['sequence'] ?? null;
        $this->signatureData = $values['signatureData'] ?? null;
        $this->walletType = $values['walletType'] ?? null;
        $this->storedId = $values['storedId'] ?? null;
        $this->storedMethodUsageType = $values['storedMethodUsageType'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
