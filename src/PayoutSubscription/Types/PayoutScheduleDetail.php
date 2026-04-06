<?php

namespace Payabli\PayoutSubscription\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Types\Frequency;

class PayoutScheduleDetail extends JsonSerializableType
{
    /**
     * @var ?string $startDate Subscription start date in any of the accepted formats: YYYY-MM-DD, MM/DD/YYYY. This must be a future date.
     */
    #[JsonProperty('startDate')]
    public ?string $startDate;

    /**
     * @var ?string $endDate Subscription end date in any of the accepted formats: YYYY-MM-DD, MM/DD/YYYY or the value `untilcancelled` to indicate a scheduled payout with infinite cycle.
     */
    #[JsonProperty('endDate')]
    public ?string $endDate;

    /**
     * @var ?value-of<Frequency> $frequency Frequency of the payout subscription.
     */
    #[JsonProperty('frequency')]
    public ?string $frequency;

    /**
     * @param array{
     *   startDate?: ?string,
     *   endDate?: ?string,
     *   frequency?: ?value-of<Frequency>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->startDate = $values['startDate'] ?? null;
        $this->endDate = $values['endDate'] ?? null;
        $this->frequency = $values['frequency'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
