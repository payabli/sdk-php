<?php

namespace Payabli\QueryTypes\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * Event data associated with an outbound transfer.
 */
class TransferOutEventData extends JsonSerializableType
{
    /**
     * @var ?string $description Description of the event.
     */
    #[JsonProperty('description')]
    public ?string $description;

    /**
     * @var ?string $eventTime The time the event occurred.
     */
    #[JsonProperty('eventTime')]
    public ?string $eventTime;

    /**
     * @var ?string $refData Reference data for the event.
     */
    #[JsonProperty('refData')]
    public ?string $refData;

    /**
     * @var mixed $extraData Additional event data, which may contain detailed transaction information.
     */
    #[JsonProperty('extraData')]
    public mixed $extraData;

    /**
     * @var ?string $source The source of the event.
     */
    #[JsonProperty('source')]
    public ?string $source;

    /**
     * @param array{
     *   description?: ?string,
     *   eventTime?: ?string,
     *   refData?: ?string,
     *   extraData?: mixed,
     *   source?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->description = $values['description'] ?? null;
        $this->eventTime = $values['eventTime'] ?? null;
        $this->refData = $values['refData'] ?? null;
        $this->extraData = $values['extraData'] ?? null;
        $this->source = $values['source'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
