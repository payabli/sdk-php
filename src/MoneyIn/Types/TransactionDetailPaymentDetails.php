<?php

namespace Payabli\MoneyIn\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Core\Types\ArrayType;

/**
 * Detailed breakdown of payment amounts and identifiers
 */
class TransactionDetailPaymentDetails extends JsonSerializableType
{
    /**
     * @var float $totalAmount
     */
    #[JsonProperty('totalAmount')]
    public float $totalAmount;

    /**
     * @var float $serviceFee
     */
    #[JsonProperty('serviceFee')]
    public float $serviceFee;

    /**
     * @var ?string $checkNumber
     */
    #[JsonProperty('checkNumber')]
    public ?string $checkNumber;

    /**
     * @var mixed $checkImage
     */
    #[JsonProperty('checkImage')]
    public mixed $checkImage;

    /**
     * @var string $checkUniqueId
     */
    #[JsonProperty('checkUniqueId')]
    public string $checkUniqueId;

    /**
     * @var string $currency
     */
    #[JsonProperty('currency')]
    public string $currency;

    /**
     * @var ?string $orderDescription
     */
    #[JsonProperty('orderDescription')]
    public ?string $orderDescription;

    /**
     * @var ?string $orderId
     */
    #[JsonProperty('orderId')]
    public ?string $orderId;

    /**
     * @var ?string $orderIdAlternative
     */
    #[JsonProperty('orderIdAlternative')]
    public ?string $orderIdAlternative;

    /**
     * @var ?string $paymentDescription
     */
    #[JsonProperty('paymentDescription')]
    public ?string $paymentDescription;

    /**
     * @var ?string $groupNumber
     */
    #[JsonProperty('groupNumber')]
    public ?string $groupNumber;

    /**
     * @var ?string $source
     */
    #[JsonProperty('source')]
    public ?string $source;

    /**
     * @var ?string $payabliTransId
     */
    #[JsonProperty('payabliTransId')]
    public ?string $payabliTransId;

    /**
     * @var mixed $unbundled
     */
    #[JsonProperty('unbundled')]
    public mixed $unbundled;

    /**
     * @var array<mixed> $categories
     */
    #[JsonProperty('categories'), ArrayType(['mixed'])]
    public array $categories;

    /**
     * @var array<mixed> $splitFunding
     */
    #[JsonProperty('splitFunding'), ArrayType(['mixed'])]
    public array $splitFunding;

    /**
     * @param array{
     *   totalAmount: float,
     *   serviceFee: float,
     *   checkUniqueId: string,
     *   currency: string,
     *   categories: array<mixed>,
     *   splitFunding: array<mixed>,
     *   checkNumber?: ?string,
     *   checkImage?: mixed,
     *   orderDescription?: ?string,
     *   orderId?: ?string,
     *   orderIdAlternative?: ?string,
     *   paymentDescription?: ?string,
     *   groupNumber?: ?string,
     *   source?: ?string,
     *   payabliTransId?: ?string,
     *   unbundled?: mixed,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->totalAmount = $values['totalAmount'];
        $this->serviceFee = $values['serviceFee'];
        $this->checkNumber = $values['checkNumber'] ?? null;
        $this->checkImage = $values['checkImage'] ?? null;
        $this->checkUniqueId = $values['checkUniqueId'];
        $this->currency = $values['currency'];
        $this->orderDescription = $values['orderDescription'] ?? null;
        $this->orderId = $values['orderId'] ?? null;
        $this->orderIdAlternative = $values['orderIdAlternative'] ?? null;
        $this->paymentDescription = $values['paymentDescription'] ?? null;
        $this->groupNumber = $values['groupNumber'] ?? null;
        $this->source = $values['source'] ?? null;
        $this->payabliTransId = $values['payabliTransId'] ?? null;
        $this->unbundled = $values['unbundled'] ?? null;
        $this->categories = $values['categories'];
        $this->splitFunding = $values['splitFunding'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
