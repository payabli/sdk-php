<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * Details of a queued or in-progress outreach call.
 */
class VendorCallStatusScheduled extends JsonSerializableType
{
    /**
     * @var ?string $scheduledFor ISO-8601 timestamp of the next scheduled call attempt.
     */
    #[JsonProperty('scheduledFor')]
    public ?string $scheduledFor;

    /**
     * @var ?int $attemptsRemaining Number of call attempts left before retries are exhausted.
     */
    #[JsonProperty('attemptsRemaining')]
    public ?int $attemptsRemaining;

    /**
     * @var ?int $maxAttempts Maximum number of call attempts configured for this schedule.
     */
    #[JsonProperty('maxAttempts')]
    public ?int $maxAttempts;

    /**
     * @param array{
     *   scheduledFor?: ?string,
     *   attemptsRemaining?: ?int,
     *   maxAttempts?: ?int,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->scheduledFor = $values['scheduledFor'] ?? null;
        $this->attemptsRemaining = $values['attemptsRemaining'] ?? null;
        $this->maxAttempts = $values['maxAttempts'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
