<?php

namespace Payabli\MoneyIn\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * Event associated with transaction processing
 */
class TransactionDetailEvent extends JsonSerializableType
{
    /**
     * @var string $transEvent
     */
    #[JsonProperty('transEvent')]
    public string $transEvent;

    /**
     * @var string $eventData
     */
    #[JsonProperty('eventData')]
    public string $eventData;

    /**
     * @var string $eventTime
     */
    #[JsonProperty('eventTime')]
    public string $eventTime;

    /**
     * @param array{
     *   transEvent: string,
     *   eventData: string,
     *   eventTime: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->transEvent = $values['transEvent'];
        $this->eventData = $values['eventData'];
        $this->eventTime = $values['eventTime'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
