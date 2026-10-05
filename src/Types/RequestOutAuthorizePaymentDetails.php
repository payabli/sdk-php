<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * Object containing payment details.
 */
class RequestOutAuthorizePaymentDetails extends JsonSerializableType
{
    /**
     * @var ?string $checkNumber
     */
    #[JsonProperty('checkNumber')]
    public ?string $checkNumber;

    /**
     * @var ?string $currency Currency code ISO-4217. If no code is provided, then the currency in the paypoint setting is used. Default is **USD**.
     */
    #[JsonProperty('currency')]
    public ?string $currency;

    /**
     * Service fee to deduct from the total amount. This amount must be a number, percentages aren't accepted. If you're using a percentage-based fee schedule, you must calculate the value manually.
     *
     * Payabli honors this field only when the paypoint's ACH payout pricing allows fee overrides. Otherwise, Payabli ignores this field and charges the fee configured in the paypoint's pricing. Contact Payabli to check or change this setting.
     *
     * When fee overrides are allowed:
     *
     * - `0` overrides the configured fee, and no fee is charged.
     * - A positive value replaces the configured fee. Payabli caps the fee at `totalAmount`.
     * - A negative value results in no fee.
     * - If you omit this field, Payabli charges the configured fee.
     *
     * The fee is deducted from the payout, so the vendor receives `totalAmount` minus the fee.
     *
     * @var ?float $serviceFee
     */
    #[JsonProperty('serviceFee')]
    public ?float $serviceFee;

    /**
     * @var ?float $totalAmount Total amount to be charged. If a service fee is included, then this amount should include the service fee. If you're using managed payables (`paymentMethod.method` of `managed`), you can partially pay a single bill by setting this below the bill's outstanding balance. See [Partially pay a bill](/guides/pay-out-developer-bills-manage#partially-pay-a-bill).
     */
    #[JsonProperty('totalAmount')]
    public ?float $totalAmount;

    /**
     * @var ?bool $unbundled Indicates whether the payout should be bundled into a single transaction or processed separately. If set to `true`, each bill will be processed as a separate payout. If `false` or not provided, then multiple bills will be paid with a single payout.
     */
    #[JsonProperty('unbundled')]
    public ?bool $unbundled;

    /**
     * @param array{
     *   checkNumber?: ?string,
     *   currency?: ?string,
     *   serviceFee?: ?float,
     *   totalAmount?: ?float,
     *   unbundled?: ?bool,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->checkNumber = $values['checkNumber'] ?? null;
        $this->currency = $values['currency'] ?? null;
        $this->serviceFee = $values['serviceFee'] ?? null;
        $this->totalAmount = $values['totalAmount'] ?? null;
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
