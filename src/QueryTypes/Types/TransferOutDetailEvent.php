<?php

namespace Payabli\QueryTypes\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * Event data for an outbound transfer detail.
 */
class TransferOutDetailEvent extends JsonSerializableType
{
    /**
     * @var ?string $transEvent Description of the transaction event.
     */
    #[JsonProperty('TransEvent')]
    public ?string $transEvent;

    /**
     * @var ?string $eventData Additional event data.
     */
    #[JsonProperty('EventData')]
    public ?string $eventData;

    /**
     * @var ?string $eventTime Time the event occurred.
     */
    #[JsonProperty('EventTime')]
    public ?string $eventTime;

    /**
     * @param array{
     *   transEvent?: ?string,
     *   eventData?: ?string,
     *   eventTime?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->transEvent = $values['transEvent'] ?? null;
        $this->eventData = $values['eventData'] ?? null;
        $this->eventTime = $values['eventTime'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
