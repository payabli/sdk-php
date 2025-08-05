<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use DateTime;
use Payabli\Core\Types\Date;

class TransferEvent extends JsonSerializableType
{
    /**
     * @var string $description Description of the transfer event.
     */
    #[JsonProperty('description')]
    public string $description;

    /**
     * @var DateTime $eventTime Date and time when the transfer event occurred.
     */
    #[JsonProperty('eventTime'), Date(Date::TYPE_DATETIME)]
    public DateTime $eventTime;

    /**
     * @var string $refData Reference data associated with the transfer event.
     */
    #[JsonProperty('refData')]
    public string $refData;

    /**
     * @var string $extraData Additional data associated with the transfer event.
     */
    #[JsonProperty('extraData')]
    public string $extraData;

    /**
     * @var string $source Source of the transfer event.
     */
    #[JsonProperty('source')]
    public string $source;

    /**
     * @param array{
     *   description: string,
     *   eventTime: DateTime,
     *   refData: string,
     *   extraData: string,
     *   source: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->description = $values['description'];
        $this->eventTime = $values['eventTime'];
        $this->refData = $values['refData'];
        $this->extraData = $values['extraData'];
        $this->source = $values['source'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
