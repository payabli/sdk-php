<?php

namespace Payabli\MoneyOut\Requests;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Types\AuthorizePayoutBody;

class PayoutRequest extends JsonSerializableType
{
    /**
     * When `true`, Payabli authorizes the payout for same-day ACH processing instead of standard ACH. Same-day ACH must be enabled for the paypoint, otherwise the authorization fails with a `400` response and `responseCode` `3492`. Only ACH payouts honor this flag. Wire and RTP payouts ignore it.
     *
     * Because this endpoint captures immediately, pass `autoConvertSameDayAch` with a value of `true` to fall back to standard ACH if the capture runs after the same-day ACH cutoff.
     *
     * @var ?bool $sameDayAch
     */
    public ?bool $sameDayAch;

    /**
     * @var ?bool $doNotCreateBills When `true`, Payabli won't automatically create a bill for this payout transaction.
     */
    public ?bool $doNotCreateBills;

    /**
     * @var ?bool $allowDuplicatedBills When `true`, the payout bypasses the requirement for unique bills, identified by vendor invoice number. This allows you to make more than one payout for a bill, like a split payment.
     */
    public ?bool $allowDuplicatedBills;

    /**
     * @var ?bool $updateVendorPaymentMethod When `true`, Payabli updates the vendor's stored default payment method to the method used in this payout.
     */
    public ?bool $updateVendorPaymentMethod;

    /**
     * Controls what happens to a payout authorized with `sameDayACH` set to `true` when the capture runs after the same-day ACH cutoff. When `true`, Payabli converts the payout to a standard ACH payment and captures it. When `false`, the capture is declined.
     *
     * This parameter has no effect on payouts that weren't authorized for same-day ACH.
     *
     * @var ?bool $autoConvertSameDayAch
     */
    public ?bool $autoConvertSameDayAch;

    /**
     * @var ?string $idempotencyKey _Optional but recommended_ A unique ID that you can include to prevent duplicating objects or transactions in the case that a request is sent more than once. This key isn't generated in Payabli, you must generate it yourself. This key persists for 2 minutes. After 2 minutes, you can reuse the key if needed.
     */
    public ?string $idempotencyKey;

    /**
     * @var AuthorizePayoutBody $body
     */
    public AuthorizePayoutBody $body;

    /**
     * @param array{
     *   body: AuthorizePayoutBody,
     *   sameDayAch?: ?bool,
     *   doNotCreateBills?: ?bool,
     *   allowDuplicatedBills?: ?bool,
     *   updateVendorPaymentMethod?: ?bool,
     *   autoConvertSameDayAch?: ?bool,
     *   idempotencyKey?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->sameDayAch = $values['sameDayAch'] ?? null;
        $this->doNotCreateBills = $values['doNotCreateBills'] ?? null;
        $this->allowDuplicatedBills = $values['allowDuplicatedBills'] ?? null;
        $this->updateVendorPaymentMethod = $values['updateVendorPaymentMethod'] ?? null;
        $this->autoConvertSameDayAch = $values['autoConvertSameDayAch'] ?? null;
        $this->idempotencyKey = $values['idempotencyKey'] ?? null;
        $this->body = $values['body'];
    }
}
