<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * Details of an outreach call that didn't complete successfully.
 */
class VendorCallStatusFailed extends JsonSerializableType
{
    /**
     * @var ?string $lastAttemptAt ISO-8601 timestamp of the most recent call attempt.
     */
    #[JsonProperty('lastAttemptAt')]
    public ?string $lastAttemptAt;

    /**
     * @var ?string $reason Reason the call didn't complete, as reported by the calling system (for example, `No answer`).
     */
    #[JsonProperty('reason')]
    public ?string $reason;

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
     * @var ?string $nextRetryScheduledFor ISO-8601 timestamp of the next scheduled retry, or `null` when no further retries are scheduled.
     */
    #[JsonProperty('nextRetryScheduledFor')]
    public ?string $nextRetryScheduledFor;

    /**
     * @param array{
     *   lastAttemptAt?: ?string,
     *   reason?: ?string,
     *   attemptsRemaining?: ?int,
     *   maxAttempts?: ?int,
     *   nextRetryScheduledFor?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->lastAttemptAt = $values['lastAttemptAt'] ?? null;
        $this->reason = $values['reason'] ?? null;
        $this->attemptsRemaining = $values['attemptsRemaining'] ?? null;
        $this->maxAttempts = $values['maxAttempts'] ?? null;
        $this->nextRetryScheduledFor = $values['nextRetryScheduledFor'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
