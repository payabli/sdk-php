<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Core\Types\Union;
use DateTime;
use Payabli\Core\Types\Date;

class QueryTransactionEvents extends JsonSerializableType
{
    /**
     * @var ?string $transEvent Event descriptor. See [TransEvent Reference](/guides/pay-in-transevents-reference) for more details.
     */
    #[JsonProperty('TransEvent')]
    public ?string $transEvent;

    /**
     * @var (
     *    array<string, mixed>
     *   |string
     * )|null $eventData Any data associated to the event received from processor. Contents vary by event type.
     */
    #[JsonProperty('EventData'), Union(['string' => 'mixed'], 'string', 'null')]
    public array|string|null $eventData;

    /**
     * @var ?DateTime $eventTime Date and time of event.
     */
    #[JsonProperty('EventTime'), Date(Date::TYPE_DATETIME)]
    public ?DateTime $eventTime;

    /**
     * @param array{
     *   transEvent?: ?string,
     *   eventData?: (
     *    array<string, mixed>
     *   |string
     * )|null,
     *   eventTime?: ?DateTime,
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
