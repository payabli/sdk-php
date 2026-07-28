<?php

namespace Payabli\MoneyOut\Requests;

use Payabli\Core\Json\JsonSerializableType;

class CaptureAllOutRequest extends JsonSerializableType
{
    /**
     * Controls what happens to a payout authorized with `sameDayACH` set to `true` when you capture it after the same-day ACH cutoff. When `true`, Payabli converts the payout to a standard ACH payment and captures it. When `false`, the capture is declined.
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
     * @var array<string> $body
     */
    public array $body;

    /**
     * @param array{
     *   body: array<string>,
     *   autoConvertSameDayAch?: ?bool,
     *   idempotencyKey?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->autoConvertSameDayAch = $values['autoConvertSameDayAch'] ?? null;
        $this->idempotencyKey = $values['idempotencyKey'] ?? null;
        $this->body = $values['body'];
    }
}
