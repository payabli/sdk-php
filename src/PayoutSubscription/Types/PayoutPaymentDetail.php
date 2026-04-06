<?php

namespace Payabli\PayoutSubscription\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * Payment details for payout subscriptions.
 */
class PayoutPaymentDetail extends JsonSerializableType
{
    /**
     * @var float $totalAmount Total payout amount. If a service fee is included, this amount should include the service fee.
     */
    #[JsonProperty('totalAmount')]
    public float $totalAmount;

    /**
     * @var ?float $serviceFee Service fee to be deducted from the total amount. This amount must be a number, percentages aren't accepted.
     */
    #[JsonProperty('serviceFee')]
    public ?float $serviceFee;

    /**
     * @var ?string $currency Currency code ISO-4217. If no code is provided, the currency in the paypoint setting is used. Default is `USD`.
     */
    #[JsonProperty('currency')]
    public ?string $currency;

    /**
     * @var ?string $checkNumber A check number for the payout. Required when the payment method is `check`.
     */
    #[JsonProperty('checkNumber')]
    public ?string $checkNumber;

    /**
     * @var ?string $orderDescription Description of the payout order.
     */
    #[JsonProperty('orderDescription')]
    public ?string $orderDescription;

    /**
     * @var ?string $orderId Order identifier associated with the payout.
     */
    #[JsonProperty('orderId')]
    public ?string $orderId;

    /**
     * @var ?string $orderIdAlternative Alternative order identifier.
     */
    #[JsonProperty('orderIdAlternative')]
    public ?string $orderIdAlternative;

    /**
     * @var ?string $paymentDescription Description of the payment.
     */
    #[JsonProperty('paymentDescription')]
    public ?string $paymentDescription;

    /**
     * @var ?string $settlementDescriptor Settlement descriptor for the payout.
     */
    #[JsonProperty('settlementDescriptor')]
    public ?string $settlementDescriptor;

    /**
     * @var ?string $groupNumber Group number for the payout.
     */
    #[JsonProperty('groupNumber')]
    public ?string $groupNumber;

    /**
     * @var ?string $source Source identifier for the payout.
     */
    #[JsonProperty('source')]
    public ?string $source;

    /**
     * @var ?string $payabliTransId Payabli transaction identifier.
     */
    #[JsonProperty('payabliTransId')]
    public ?string $payabliTransId;

    /**
     * @var ?bool $unbundled When `true`, each bill is processed as a separate payout. When `false` or not provided, multiple bills are paid with a single payout.
     */
    #[JsonProperty('unbundled')]
    public ?bool $unbundled;

    /**
     * @param array{
     *   totalAmount: float,
     *   serviceFee?: ?float,
     *   currency?: ?string,
     *   checkNumber?: ?string,
     *   orderDescription?: ?string,
     *   orderId?: ?string,
     *   orderIdAlternative?: ?string,
     *   paymentDescription?: ?string,
     *   settlementDescriptor?: ?string,
     *   groupNumber?: ?string,
     *   source?: ?string,
     *   payabliTransId?: ?string,
     *   unbundled?: ?bool,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->totalAmount = $values['totalAmount'];
        $this->serviceFee = $values['serviceFee'] ?? null;
        $this->currency = $values['currency'] ?? null;
        $this->checkNumber = $values['checkNumber'] ?? null;
        $this->orderDescription = $values['orderDescription'] ?? null;
        $this->orderId = $values['orderId'] ?? null;
        $this->orderIdAlternative = $values['orderIdAlternative'] ?? null;
        $this->paymentDescription = $values['paymentDescription'] ?? null;
        $this->settlementDescriptor = $values['settlementDescriptor'] ?? null;
        $this->groupNumber = $values['groupNumber'] ?? null;
        $this->source = $values['source'] ?? null;
        $this->payabliTransId = $values['payabliTransId'] ?? null;
        $this->unbundled = $values['unbundled'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
