<?php

namespace Payabli\Funding\Requests;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

class DepositFundsRequest extends JsonSerializableType
{
    /**
     * @var float $amount The amount to deposit, in dollars. Must be greater than zero.
     */
    #[JsonProperty('amount')]
    public float $amount;

    /**
     * @var string $entrypoint The entry point identifier for the paypoint receiving the deposit.
     */
    #[JsonProperty('entrypoint')]
    public string $entrypoint;

    /**
     * @var string $accountId The remittance account ID to withdraw funds from.
     */
    #[JsonProperty('accountId')]
    public string $accountId;

    /**
     * @var ?int $paypointId The paypoint ID. Optional if the entry point uniquely identifies the paypoint.
     */
    #[JsonProperty('paypointId')]
    public ?int $paypointId;

    /**
     * @var ?bool $sameDayAch When `true` and the request is submitted before 2 PM ET, the deposit processes as same-day ACH. If the request is submitted after 2 PM ET, it processes as standard ACH regardless of this flag.
     */
    #[JsonProperty('sameDayAch')]
    public ?bool $sameDayAch;

    /**
     * @param array{
     *   amount: float,
     *   entrypoint: string,
     *   accountId: string,
     *   paypointId?: ?int,
     *   sameDayAch?: ?bool,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->amount = $values['amount'];
        $this->entrypoint = $values['entrypoint'];
        $this->accountId = $values['accountId'];
        $this->paypointId = $values['paypointId'] ?? null;
        $this->sameDayAch = $values['sameDayAch'] ?? null;
    }
}
