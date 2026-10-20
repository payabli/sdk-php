<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Core\Types\ArrayType;

/**
 * A single transition in an application's status history.
 */
class StatusHistoryEntry extends JsonSerializableType
{
    /**
     * @var string $fromStatus The status before the transition. The transition that creates the application has a `fromStatus` of `none`.
     */
    #[JsonProperty('fromStatus')]
    public string $fromStatus;

    /**
     * @var string $toStatus The status after the transition.
     */
    #[JsonProperty('toStatus')]
    public string $toStatus;

    /**
     * @var string $trigger What triggered the transition (for example, `Create` or `Withdraw`).
     */
    #[JsonProperty('trigger')]
    public string $trigger;

    /**
     * @var ?string $actor The identifier of the actor that triggered the transition.
     */
    #[JsonProperty('actor')]
    public ?string $actor;

    /**
     * @var ?string $reason The reason recorded for the transition.
     */
    #[JsonProperty('reason')]
    public ?string $reason;

    /**
     * @var ?array<string, mixed> $metadata Additional metadata about the transition.
     */
    #[JsonProperty('metadata'), ArrayType(['string' => 'mixed'])]
    public ?array $metadata;

    /**
     * @var string $createdAt When the transition occurred.
     */
    #[JsonProperty('createdAt')]
    public string $createdAt;

    /**
     * @param array{
     *   fromStatus: string,
     *   toStatus: string,
     *   trigger: string,
     *   createdAt: string,
     *   actor?: ?string,
     *   reason?: ?string,
     *   metadata?: ?array<string, mixed>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->fromStatus = $values['fromStatus'];
        $this->toStatus = $values['toStatus'];
        $this->trigger = $values['trigger'];
        $this->actor = $values['actor'] ?? null;
        $this->reason = $values['reason'] ?? null;
        $this->metadata = $values['metadata'] ?? null;
        $this->createdAt = $values['createdAt'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
