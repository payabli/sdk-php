<?php

namespace Payabli\MoneyOut\Requests;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Types\AuthorizePayoutBody;

class RequestOutAuthorize extends JsonSerializableType
{
    /**
     * @var ?bool $allowDuplicatedBills When `true`, the authorization bypasses the requirement for unique bills, identified by vendor invoice number. This allows you to make more than one payout authorization for a bill, like a split payment.
     */
    public ?bool $allowDuplicatedBills;

    /**
     * @var ?bool $doNotCreateBills When `true`, Payabli won't automatically create a bill for this payout transaction.
     */
    public ?bool $doNotCreateBills;

    /**
     * When `true`, Payabli authorizes the payout for same-day ACH processing instead of standard ACH. Same-day ACH must be enabled for the paypoint, otherwise the authorization fails with a `400` response and `responseCode` `3492`. Only ACH payouts honor this flag. Wire and RTP payouts ignore it.
     *
     * Same-day ACH has a daily cutoff. Capture the transaction before the cutoff, or pass `autoConvertSameDayAch` with a value of `true` when you capture it.
     *
     * @var ?bool $sameDayAch
     */
    public ?bool $sameDayAch;

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
     *   allowDuplicatedBills?: ?bool,
     *   doNotCreateBills?: ?bool,
     *   sameDayAch?: ?bool,
     *   idempotencyKey?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->allowDuplicatedBills = $values['allowDuplicatedBills'] ?? null;
        $this->doNotCreateBills = $values['doNotCreateBills'] ?? null;
        $this->sameDayAch = $values['sameDayAch'] ?? null;
        $this->idempotencyKey = $values['idempotencyKey'] ?? null;
        $this->body = $values['body'];
    }
}
