<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use DateTime;
use Payabli\Core\Types\Date;
use Payabli\Core\Types\ArrayType;

/**
 * A bank-account-change case.
 */
class CaseResponse extends JsonSerializableType
{
    /**
     * @var string $uuid The case's unique identifier.
     */
    #[JsonProperty('uuid')]
    public string $uuid;

    /**
     * @var value-of<CaseState> $state
     */
    #[JsonProperty('state')]
    public string $state;

    /**
     * @var value-of<CaseType> $caseType
     */
    #[JsonProperty('caseType')]
    public string $caseType;

    /**
     * @var BankAccountChangeParameters $parameters
     */
    #[JsonProperty('parameters')]
    public BankAccountChangeParameters $parameters;

    /**
     * @var int $orgId The organization that owns the case.
     */
    #[JsonProperty('orgId')]
    public int $orgId;

    /**
     * @var int $paypointId The paypoint the case applies to.
     */
    #[JsonProperty('paypointId')]
    public int $paypointId;

    /**
     * @var ?DateTime $scheduleFor When the change is scheduled to run. Null when not scheduled.
     */
    #[JsonProperty('scheduleFor'), Date(Date::TYPE_DATETIME)]
    public ?DateTime $scheduleFor;

    /**
     * @var DateTime $createdAt When the case was created.
     */
    #[JsonProperty('createdAt'), Date(Date::TYPE_DATETIME)]
    public DateTime $createdAt;

    /**
     * @var DateTime $updatedAt When the case was last updated.
     */
    #[JsonProperty('updatedAt'), Date(Date::TYPE_DATETIME)]
    public DateTime $updatedAt;

    /**
     * @var int $createdBy The numeric id of the user who created the case. `0` when created by a server-side integration.
     */
    #[JsonProperty('createdBy')]
    public int $createdBy;

    /**
     * @var ?int $assigneeId The numeric id of the assigned reviewer. Null when unassigned.
     */
    #[JsonProperty('assigneeId')]
    public ?int $assigneeId;

    /**
     * @var ?int $lastReviewedById The numeric id of the last reviewer. Null when not yet reviewed.
     */
    #[JsonProperty('lastReviewedById')]
    public ?int $lastReviewedById;

    /**
     * @var array<StateTransitionResponse> $stateHistory The ordered history of state transitions.
     */
    #[JsonProperty('stateHistory'), ArrayType([StateTransitionResponse::class])]
    public array $stateHistory;

    /**
     * @var array<AttachmentResponse> $attachments Files attached to the case.
     */
    #[JsonProperty('attachments'), ArrayType([AttachmentResponse::class])]
    public array $attachments;

    /**
     * @var ?int $roomId The id of the message room for the case. Null until provisioned.
     */
    #[JsonProperty('roomId')]
    public ?int $roomId;

    /**
     * @var ?CaseMetadata $metadata Case metadata, including the verification outcome. Null until verification completes.
     */
    #[JsonProperty('metadata')]
    public ?CaseMetadata $metadata;

    /**
     * @var ?OrgRef $org The resolved organization. Null when not enriched.
     */
    #[JsonProperty('org')]
    public ?OrgRef $org;

    /**
     * @var ?PaypointRef $paypoint The resolved paypoint. Null when not enriched.
     */
    #[JsonProperty('paypoint')]
    public ?PaypointRef $paypoint;

    /**
     * @var ?UserRef $createdByUser The resolved creator. Null when created by a server-side integration or not enriched.
     */
    #[JsonProperty('createdByUser')]
    public ?UserRef $createdByUser;

    /**
     * @var ?UserRef $assignee The resolved assigned reviewer. Null when unassigned.
     */
    #[JsonProperty('assignee')]
    public ?UserRef $assignee;

    /**
     * @var ?UserRef $lastReviewedBy The resolved last reviewer. Null when not yet reviewed.
     */
    #[JsonProperty('lastReviewedBy')]
    public ?UserRef $lastReviewedBy;

    /**
     * @param array{
     *   uuid: string,
     *   state: value-of<CaseState>,
     *   caseType: value-of<CaseType>,
     *   parameters: BankAccountChangeParameters,
     *   orgId: int,
     *   paypointId: int,
     *   createdAt: DateTime,
     *   updatedAt: DateTime,
     *   createdBy: int,
     *   stateHistory: array<StateTransitionResponse>,
     *   attachments: array<AttachmentResponse>,
     *   scheduleFor?: ?DateTime,
     *   assigneeId?: ?int,
     *   lastReviewedById?: ?int,
     *   roomId?: ?int,
     *   metadata?: ?CaseMetadata,
     *   org?: ?OrgRef,
     *   paypoint?: ?PaypointRef,
     *   createdByUser?: ?UserRef,
     *   assignee?: ?UserRef,
     *   lastReviewedBy?: ?UserRef,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->uuid = $values['uuid'];
        $this->state = $values['state'];
        $this->caseType = $values['caseType'];
        $this->parameters = $values['parameters'];
        $this->orgId = $values['orgId'];
        $this->paypointId = $values['paypointId'];
        $this->scheduleFor = $values['scheduleFor'] ?? null;
        $this->createdAt = $values['createdAt'];
        $this->updatedAt = $values['updatedAt'];
        $this->createdBy = $values['createdBy'];
        $this->assigneeId = $values['assigneeId'] ?? null;
        $this->lastReviewedById = $values['lastReviewedById'] ?? null;
        $this->stateHistory = $values['stateHistory'];
        $this->attachments = $values['attachments'];
        $this->roomId = $values['roomId'] ?? null;
        $this->metadata = $values['metadata'] ?? null;
        $this->org = $values['org'] ?? null;
        $this->paypoint = $values['paypoint'] ?? null;
        $this->createdByUser = $values['createdByUser'] ?? null;
        $this->assignee = $values['assignee'] ?? null;
        $this->lastReviewedBy = $values['lastReviewedBy'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
