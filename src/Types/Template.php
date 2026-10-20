<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * A boarding template, including its current content version.
 */
class Template extends JsonSerializableType
{
    /**
     * @var string $uuid The template's unique identifier, used to read and manage the template.
     */
    #[JsonProperty('uuid')]
    public string $uuid;

    /**
     * @var int $orgId The numeric identifier of the organization that owns the template.
     */
    #[JsonProperty('orgId')]
    public int $orgId;

    /**
     * @var ?string $orgName The name of the organization that owns the template.
     */
    #[JsonProperty('orgName')]
    public ?string $orgName;

    /**
     * @var string $name The template's display name.
     */
    #[JsonProperty('name')]
    public string $name;

    /**
     * @var ?string $description An optional description of the template.
     */
    #[JsonProperty('description')]
    public ?string $description;

    /**
     * @var ?string $slug An optional URL-friendly identifier for the template.
     */
    #[JsonProperty('slug')]
    public ?string $slug;

    /**
     * @var value-of<TemplateStatus> $status
     */
    #[JsonProperty('status')]
    public string $status;

    /**
     * @var string $currentVersionUuid The UUID of the template's active content version.
     */
    #[JsonProperty('currentVersionUuid')]
    public string $currentVersionUuid;

    /**
     * @var TemplateVersion $currentVersion The template's active content version.
     */
    #[JsonProperty('currentVersion')]
    public TemplateVersion $currentVersion;

    /**
     * @var bool $isInherited Whether the template is inherited from an ancestor organization rather than owned directly.
     */
    #[JsonProperty('isInherited')]
    public bool $isInherited;

    /**
     * @var bool $readOnly Whether the template is read-only for the calling organization.
     */
    #[JsonProperty('readOnly')]
    public bool $readOnly;

    /**
     * @var string $createdBy The identifier of the user who created the template.
     */
    #[JsonProperty('createdBy')]
    public string $createdBy;

    /**
     * @var string $updatedBy The identifier of the user who last updated the template.
     */
    #[JsonProperty('updatedBy')]
    public string $updatedBy;

    /**
     * @var string $createdAt When the template was created.
     */
    #[JsonProperty('createdAt')]
    public string $createdAt;

    /**
     * @var string $updatedAt When the template was last updated.
     */
    #[JsonProperty('updatedAt')]
    public string $updatedAt;

    /**
     * @param array{
     *   uuid: string,
     *   orgId: int,
     *   name: string,
     *   status: value-of<TemplateStatus>,
     *   currentVersionUuid: string,
     *   currentVersion: TemplateVersion,
     *   isInherited: bool,
     *   readOnly: bool,
     *   createdBy: string,
     *   updatedBy: string,
     *   createdAt: string,
     *   updatedAt: string,
     *   orgName?: ?string,
     *   description?: ?string,
     *   slug?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->uuid = $values['uuid'];
        $this->orgId = $values['orgId'];
        $this->orgName = $values['orgName'] ?? null;
        $this->name = $values['name'];
        $this->description = $values['description'] ?? null;
        $this->slug = $values['slug'] ?? null;
        $this->status = $values['status'];
        $this->currentVersionUuid = $values['currentVersionUuid'];
        $this->currentVersion = $values['currentVersion'];
        $this->isInherited = $values['isInherited'];
        $this->readOnly = $values['readOnly'];
        $this->createdBy = $values['createdBy'];
        $this->updatedBy = $values['updatedBy'];
        $this->createdAt = $values['createdAt'];
        $this->updatedAt = $values['updatedAt'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
