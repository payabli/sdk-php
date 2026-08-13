<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use DateTime;
use Payabli\Core\Types\Date;
use Payabli\Core\Types\ArrayType;

/**
 * A billing profile assigned to an entity, returned by the View profile
 * endpoint. A profile is a named configuration of billable events, each with
 * one or more fee schedules. Profiles are append-only versioned — every edit
 * mints a new version.
 */
class BillingProfileResponse extends JsonSerializableType
{
    /**
     * @var int $id Unique, server-generated profile identifier.
     */
    #[JsonProperty('id')]
    public int $id;

    /**
     * @var int $versionId Identifier of this specific version of the profile.
     */
    #[JsonProperty('versionId')]
    public int $versionId;

    /**
     * Sequential version counter. Starts at `1` and increments on every edit
     * (profiles are append-only versioned, not mutated in place).
     *
     * @var int $versionNumber
     */
    #[JsonProperty('versionNumber')]
    public int $versionNumber;

    /**
     * @var BillingEntity $business
     */
    #[JsonProperty('business')]
    public BillingEntity $business;

    /**
     * @var string $name Descriptive name for the profile.
     */
    #[JsonProperty('name')]
    public string $name;

    /**
     * @var int $feeType
     */
    #[JsonProperty('feeType')]
    public int $feeType;

    /**
     * @var DateTime $createdAt When this version was created.
     */
    #[JsonProperty('createdAt'), Date(Date::TYPE_DATETIME)]
    public DateTime $createdAt;

    /**
     * @var DateTime $updatedAt When this version was last updated.
     */
    #[JsonProperty('updatedAt'), Date(Date::TYPE_DATETIME)]
    public DateTime $updatedAt;

    /**
     * Parent-entity reference used for inheritance and permission checks,
     * formatted as `{entityType}:{entityId}` (for example, `1:2` is
     * organization `2`). Org-level profiles reference their own organization;
     * paypoint-level profiles reference their parent organization.
     *
     * @var string $parentId
     */
    #[JsonProperty('parentId')]
    public string $parentId;

    /**
     * @var array<BillableEvent> $billableEvents The chargeable events this profile covers.
     */
    #[JsonProperty('billableEvents'), ArrayType([BillableEvent::class])]
    public array $billableEvents;

    /**
     * @param array{
     *   id: int,
     *   versionId: int,
     *   versionNumber: int,
     *   business: BillingEntity,
     *   name: string,
     *   feeType: int,
     *   createdAt: DateTime,
     *   updatedAt: DateTime,
     *   parentId: string,
     *   billableEvents: array<BillableEvent>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->id = $values['id'];
        $this->versionId = $values['versionId'];
        $this->versionNumber = $values['versionNumber'];
        $this->business = $values['business'];
        $this->name = $values['name'];
        $this->feeType = $values['feeType'];
        $this->createdAt = $values['createdAt'];
        $this->updatedAt = $values['updatedAt'];
        $this->parentId = $values['parentId'];
        $this->billableEvents = $values['billableEvents'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
