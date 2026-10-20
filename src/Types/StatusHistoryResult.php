<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Core\Types\ArrayType;

/**
 * An application's status history.
 */
class StatusHistoryResult extends JsonSerializableType
{
    /**
     * @var string $requestsReference The application reference.
     */
    #[JsonProperty('requestsReference')]
    public string $requestsReference;

    /**
     * @var array<StatusHistoryEntry> $history The status transitions, oldest first.
     */
    #[JsonProperty('history'), ArrayType([StatusHistoryEntry::class])]
    public array $history;

    /**
     * @param array{
     *   requestsReference: string,
     *   history: array<StatusHistoryEntry>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->requestsReference = $values['requestsReference'];
        $this->history = $values['history'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
