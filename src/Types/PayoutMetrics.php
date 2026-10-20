<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * Expected Pay Out profile for the business.
 */
class PayoutMetrics extends JsonSerializableType
{
    /**
     * @var ?float $monthlyPayablesVolume Expected monthly Pay Out volume.
     */
    #[JsonProperty('monthlyPayablesVolume')]
    public ?float $monthlyPayablesVolume;

    /**
     * @var ?float $averagePayablesSize Expected average payout amount.
     */
    #[JsonProperty('averagePayablesSize')]
    public ?float $averagePayablesSize;

    /**
     * @var ?float $largestPayablesSize Expected largest payout amount.
     */
    #[JsonProperty('largestPayablesSize')]
    public ?float $largestPayablesSize;

    /**
     * @var ?int $numberOfTransactions Expected number of payouts per month.
     */
    #[JsonProperty('numberOfTransactions')]
    public ?int $numberOfTransactions;

    /**
     * @param array{
     *   monthlyPayablesVolume?: ?float,
     *   averagePayablesSize?: ?float,
     *   largestPayablesSize?: ?float,
     *   numberOfTransactions?: ?int,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->monthlyPayablesVolume = $values['monthlyPayablesVolume'] ?? null;
        $this->averagePayablesSize = $values['averagePayablesSize'] ?? null;
        $this->largestPayablesSize = $values['largestPayablesSize'] ?? null;
        $this->numberOfTransactions = $values['numberOfTransactions'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
