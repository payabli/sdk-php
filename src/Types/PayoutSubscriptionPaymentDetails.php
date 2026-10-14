<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Core\Types\ArrayType;

/**
 * Payment details for the payout subscription.
 */
class PayoutSubscriptionPaymentDetails extends JsonSerializableType
{
    /**
     * @var ?float $totalAmount Total payout amount, including any service fee.
     */
    #[JsonProperty('totalAmount')]
    public ?float $totalAmount;

    /**
     * @var ?float $serviceFee Service fee deducted from the total amount.
     */
    #[JsonProperty('serviceFee')]
    public ?float $serviceFee;

    /**
     * @var ?float $surchargeFee Surcharge amount. Always `0` for payout subscriptions.
     */
    #[JsonProperty('surchargeFee')]
    public ?float $surchargeFee;

    /**
     * @var ?string $checkNumber Check number for the payout. Set when the payment method is `check`.
     */
    #[JsonProperty('checkNumber')]
    public ?string $checkNumber;

    /**
     * @var ?array<string, mixed> $checkImage Object containing an image of a paper check.
     */
    #[JsonProperty('checkImage'), ArrayType(['string' => 'mixed'])]
    public ?array $checkImage;

    /**
     * @var ?string $checkUniqueId Unique identifier for a processed check image.
     */
    #[JsonProperty('checkUniqueId')]
    public ?string $checkUniqueId;

    /**
     * @var ?string $currency Currency code ISO-4217.
     */
    #[JsonProperty('currency')]
    public ?string $currency;

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
     * @var ?string $settlementDescriptor Settlement descriptor for the payout. Always `null` on this endpoint.
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
     * @var ?string $payabliTransId Payabli transaction identifier. Always `null` on this endpoint.
     */
    #[JsonProperty('payabliTransId')]
    public ?string $payabliTransId;

    /**
     * @var ?bool $unbundled When `true`, each bill is processed as a separate payout. Always `null` on this endpoint.
     */
    #[JsonProperty('unbundled')]
    public ?bool $unbundled;

    /**
     * @var ?array<PaymentCategories> $categories Payment categories or line items describing the amount.
     */
    #[JsonProperty('categories'), ArrayType([PaymentCategories::class])]
    public ?array $categories;

    /**
     * @var ?array<SplitFundingContent> $splitFunding
     */
    #[JsonProperty('splitFunding'), ArrayType([SplitFundingContent::class])]
    public ?array $splitFunding;

    /**
     * @param array{
     *   totalAmount?: ?float,
     *   serviceFee?: ?float,
     *   surchargeFee?: ?float,
     *   checkNumber?: ?string,
     *   checkImage?: ?array<string, mixed>,
     *   checkUniqueId?: ?string,
     *   currency?: ?string,
     *   orderDescription?: ?string,
     *   orderId?: ?string,
     *   orderIdAlternative?: ?string,
     *   paymentDescription?: ?string,
     *   settlementDescriptor?: ?string,
     *   groupNumber?: ?string,
     *   source?: ?string,
     *   payabliTransId?: ?string,
     *   unbundled?: ?bool,
     *   categories?: ?array<PaymentCategories>,
     *   splitFunding?: ?array<SplitFundingContent>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->totalAmount = $values['totalAmount'] ?? null;
        $this->serviceFee = $values['serviceFee'] ?? null;
        $this->surchargeFee = $values['surchargeFee'] ?? null;
        $this->checkNumber = $values['checkNumber'] ?? null;
        $this->checkImage = $values['checkImage'] ?? null;
        $this->checkUniqueId = $values['checkUniqueId'] ?? null;
        $this->currency = $values['currency'] ?? null;
        $this->orderDescription = $values['orderDescription'] ?? null;
        $this->orderId = $values['orderId'] ?? null;
        $this->orderIdAlternative = $values['orderIdAlternative'] ?? null;
        $this->paymentDescription = $values['paymentDescription'] ?? null;
        $this->settlementDescriptor = $values['settlementDescriptor'] ?? null;
        $this->groupNumber = $values['groupNumber'] ?? null;
        $this->source = $values['source'] ?? null;
        $this->payabliTransId = $values['payabliTransId'] ?? null;
        $this->unbundled = $values['unbundled'] ?? null;
        $this->categories = $values['categories'] ?? null;
        $this->splitFunding = $values['splitFunding'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
