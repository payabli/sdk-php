<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

class SubscriptionStatsQueryRecord extends JsonSerializableType
{
    /**
     * @var string $interval The renewal window this row represents: `30` (due within 30 days), `60` (31 to 60 days), `90` (61 to 90 days), or `+90` (more than 90 days out). Note the response label `+90` differs from its request path value `plus`. Requesting `all` returns one row per window.
     */
    #[JsonProperty('interval')]
    public string $interval;

    /**
     * @var int $count Number of active subscriptions scheduled to renew within this window. This is a forecast of upcoming renewals, not charges already taken, so it doesn't reconcile with `inSubscriptionsPaid` on `/Statistic/basic`.
     */
    #[JsonProperty('count')]
    public int $count;

    /**
     * @var float $volume Total value of the upcoming renewals in this window, net of fees.
     */
    #[JsonProperty('volume')]
    public float $volume;

    /**
     * @param array{
     *   interval: string,
     *   count: int,
     *   volume: float,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->interval = $values['interval'];
        $this->count = $values['count'];
        $this->volume = $values['volume'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
