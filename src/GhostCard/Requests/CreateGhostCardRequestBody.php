<?php

namespace Payabli\GhostCard\Requests;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

class CreateGhostCardRequestBody extends JsonSerializableType
{
    /**
     * @var int $vendorId ID of the vendor who receives the card. The vendor must belong to the paypoint and have an active status.
     */
    #[JsonProperty('vendorId')]
    public int $vendorId;

    /**
     * @var float $expenseLimit Spending limit for the card. Must be greater than `0` and can't exceed the paypoint's configured payout credit limit.
     */
    #[JsonProperty('expenseLimit')]
    public float $expenseLimit;

    /**
     * @var ?string $expirationDate Requested expiration date for the card. If not provided, defaults to 30 days from creation.
     */
    #[JsonProperty('expirationDate')]
    public ?string $expirationDate;

    /**
     * @var float $amount Initial load amount for the card.
     */
    #[JsonProperty('amount')]
    public float $amount;

    /**
     * @var int $maxNumberOfUses Maximum number of times the card can be used. Ignored and set to `1` when `exactAmount` is `true`.
     */
    #[JsonProperty('maxNumberOfUses')]
    public int $maxNumberOfUses;

    /**
     * @var bool $exactAmount When `true`, restricts the card to a single use. `maxNumberOfUses` is automatically set to `1` regardless of any other value provided.
     */
    #[JsonProperty('exactAmount')]
    public bool $exactAmount;

    /**
     * @var string $expenseLimitPeriod Time period over which `expenseLimit` applies (for example, `monthly` or `weekly`).
     */
    #[JsonProperty('expenseLimitPeriod')]
    public string $expenseLimitPeriod;

    /**
     * @var string $billingCycle Billing cycle identifier.
     */
    #[JsonProperty('billingCycle')]
    public string $billingCycle;

    /**
     * @var string $billingCycleDay Day within the billing cycle.
     */
    #[JsonProperty('billingCycleDay')]
    public string $billingCycleDay;

    /**
     * @var int $dailyTransactionCount Maximum number of transactions allowed per day.
     */
    #[JsonProperty('dailyTransactionCount')]
    public int $dailyTransactionCount;

    /**
     * @var float $dailyAmountLimit Maximum total spend allowed per day.
     */
    #[JsonProperty('dailyAmountLimit')]
    public float $dailyAmountLimit;

    /**
     * @var int $transactionAmountLimit Maximum spend allowed per single transaction.
     */
    #[JsonProperty('transactionAmountLimit')]
    public int $transactionAmountLimit;

    /**
     * @var ?string $mcc Merchant Category Code to restrict where the card can be used. Must be a valid MCC if provided.
     */
    #[JsonProperty('mcc')]
    public ?string $mcc;

    /**
     * @var ?string $tcc Transaction Category Code to restrict where the card can be used. Must be a valid TCC if provided.
     */
    #[JsonProperty('tcc')]
    public ?string $tcc;

    /**
     * @var ?string $misc1 Custom metadata field. Stored on the card record.
     */
    #[JsonProperty('misc1')]
    public ?string $misc1;

    /**
     * @var ?string $misc2 Custom metadata field. Stored on the card record.
     */
    #[JsonProperty('misc2')]
    public ?string $misc2;

    /**
     * @param array{
     *   vendorId: int,
     *   expenseLimit: float,
     *   amount: float,
     *   maxNumberOfUses: int,
     *   exactAmount: bool,
     *   expenseLimitPeriod: string,
     *   billingCycle: string,
     *   billingCycleDay: string,
     *   dailyTransactionCount: int,
     *   dailyAmountLimit: float,
     *   transactionAmountLimit: int,
     *   expirationDate?: ?string,
     *   mcc?: ?string,
     *   tcc?: ?string,
     *   misc1?: ?string,
     *   misc2?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->vendorId = $values['vendorId'];
        $this->expenseLimit = $values['expenseLimit'];
        $this->expirationDate = $values['expirationDate'] ?? null;
        $this->amount = $values['amount'];
        $this->maxNumberOfUses = $values['maxNumberOfUses'];
        $this->exactAmount = $values['exactAmount'];
        $this->expenseLimitPeriod = $values['expenseLimitPeriod'];
        $this->billingCycle = $values['billingCycle'];
        $this->billingCycleDay = $values['billingCycleDay'];
        $this->dailyTransactionCount = $values['dailyTransactionCount'];
        $this->dailyAmountLimit = $values['dailyAmountLimit'];
        $this->transactionAmountLimit = $values['transactionAmountLimit'];
        $this->mcc = $values['mcc'] ?? null;
        $this->tcc = $values['tcc'] ?? null;
        $this->misc1 = $values['misc1'] ?? null;
        $this->misc2 = $values['misc2'] ?? null;
    }
}
