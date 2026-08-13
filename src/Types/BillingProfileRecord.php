<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use DateTime;
use Payabli\Core\Types\Date;

/**
 * A single billing profile as it appears in the list.
 */
class BillingProfileRecord extends JsonSerializableType
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
     * @var int $versionNumber Sequential version counter. Starts at `1` and increments on every edit.
     */
    #[JsonProperty('versionNumber')]
    public int $versionNumber;

    /**
     * @var BillingEntityNamed $business
     */
    #[JsonProperty('business')]
    public BillingEntityNamed $business;

    /**
     * @var value-of<ServiceVerticalName> $serviceVertical
     */
    #[JsonProperty('serviceVertical')]
    public string $serviceVertical;

    /**
     * @var string $name Descriptive name for the profile.
     */
    #[JsonProperty('name')]
    public string $name;

    /**
     * @var value-of<FeeTypeName> $feeType
     */
    #[JsonProperty('feeType')]
    public string $feeType;

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
     * @var EntitiesAssigned $entitiesAssigned
     */
    #[JsonProperty('entitiesAssigned')]
    public EntitiesAssigned $entitiesAssigned;

    /**
     * Parent-entity reference formatted as `{entityType}:{entityId}` (for
     * example, `1:2`).
     *
     * @var string $parentId
     */
    #[JsonProperty('parentId')]
    public string $parentId;

    /**
     * @var int $countOfEvents Number of billable events configured on the profile.
     */
    #[JsonProperty('countOfEvents')]
    public int $countOfEvents;

    /**
     * @param array{
     *   id: int,
     *   versionId: int,
     *   versionNumber: int,
     *   business: BillingEntityNamed,
     *   serviceVertical: value-of<ServiceVerticalName>,
     *   name: string,
     *   feeType: value-of<FeeTypeName>,
     *   createdAt: DateTime,
     *   updatedAt: DateTime,
     *   entitiesAssigned: EntitiesAssigned,
     *   parentId: string,
     *   countOfEvents: int,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->id = $values['id'];
        $this->versionId = $values['versionId'];
        $this->versionNumber = $values['versionNumber'];
        $this->business = $values['business'];
        $this->serviceVertical = $values['serviceVertical'];
        $this->name = $values['name'];
        $this->feeType = $values['feeType'];
        $this->createdAt = $values['createdAt'];
        $this->updatedAt = $values['updatedAt'];
        $this->entitiesAssigned = $values['entitiesAssigned'];
        $this->parentId = $values['parentId'];
        $this->countOfEvents = $values['countOfEvents'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
