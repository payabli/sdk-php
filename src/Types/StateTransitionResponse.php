<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use DateTime;
use Payabli\Core\Types\Date;

/**
 * A single entry in a case's state history.
 */
class StateTransitionResponse extends JsonSerializableType
{
    /**
     * @var string $uuid The transition's unique identifier.
     */
    #[JsonProperty('uuid')]
    public string $uuid;

    /**
     * @var string $caseUuid The case this transition belongs to.
     */
    #[JsonProperty('caseUuid')]
    public string $caseUuid;

    /**
     * @var value-of<CaseState> $fromState
     */
    #[JsonProperty('fromState')]
    public string $fromState;

    /**
     * @var value-of<CaseState> $toState
     */
    #[JsonProperty('toState')]
    public string $toState;

    /**
     * @var ?string $ipAddress The IP address of the actor. Null for system transitions.
     */
    #[JsonProperty('ipAddress')]
    public ?string $ipAddress;

    /**
     * @var ?int $triggeredBy The numeric id of the user who triggered the transition. Null for system transitions.
     */
    #[JsonProperty('triggeredBy')]
    public ?int $triggeredBy;

    /**
     * @var ?string $reason The reason recorded for the transition.
     */
    #[JsonProperty('reason')]
    public ?string $reason;

    /**
     * @var DateTime $createdAt When the transition occurred.
     */
    #[JsonProperty('createdAt'), Date(Date::TYPE_DATETIME)]
    public DateTime $createdAt;

    /**
     * @var ?UserRef $triggeredByUser The resolved user who triggered the transition. Null for system transitions.
     */
    #[JsonProperty('triggeredByUser')]
    public ?UserRef $triggeredByUser;

    /**
     * @param array{
     *   uuid: string,
     *   caseUuid: string,
     *   fromState: value-of<CaseState>,
     *   toState: value-of<CaseState>,
     *   createdAt: DateTime,
     *   ipAddress?: ?string,
     *   triggeredBy?: ?int,
     *   reason?: ?string,
     *   triggeredByUser?: ?UserRef,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->uuid = $values['uuid'];
        $this->caseUuid = $values['caseUuid'];
        $this->fromState = $values['fromState'];
        $this->toState = $values['toState'];
        $this->ipAddress = $values['ipAddress'] ?? null;
        $this->triggeredBy = $values['triggeredBy'] ?? null;
        $this->reason = $values['reason'] ?? null;
        $this->createdAt = $values['createdAt'];
        $this->triggeredByUser = $values['triggeredByUser'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
