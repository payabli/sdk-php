<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Traits\ApplicationCommon;
use Payabli\Core\Json\JsonProperty;

/**
 * A boarding application (request), as returned in a list of applications.
 */
class ApplicationListItem extends JsonSerializableType
{
    use ApplicationCommon;

    /**
     * @var ?string $paypointName The name of the paypoint being boarded.
     */
    #[JsonProperty('paypointName')]
    public ?string $paypointName;

    /**
     * @var ?string $paypointLegalName The legal name of the paypoint being boarded.
     */
    #[JsonProperty('paypointLegalName')]
    public ?string $paypointLegalName;

    /**
     * @var ?string $ein The employer identification number, masked (for example `****8993`).
     */
    #[JsonProperty('ein')]
    public ?string $ein;

    /**
     * @var ?string $primaryOwnerName The name of the primary owner.
     */
    #[JsonProperty('primaryOwnerName')]
    public ?string $primaryOwnerName;

    /**
     * @var ?string $primaryOwnerReference The reference of the primary owner.
     */
    #[JsonProperty('primaryOwnerReference')]
    public ?string $primaryOwnerReference;

    /**
     * @param array{
     *   requestsReference: string,
     *   businessReference: string,
     *   applicationStatus: string,
     *   applicationStatusCode: int,
     *   allowedActions: array<string>,
     *   createdAt: string,
     *   links: ApplicationLinks,
     *   externalId?: ?string,
     *   parent?: ?string,
     *   parentOrgName?: ?string,
     *   entityType?: ?string,
     *   dbaName?: ?string,
     *   requestTemplate?: ?string,
     *   services?: ?RequestedServices,
     *   tags?: ?array<string>,
     *   representatives?: ?array<RepresentativeResponse>,
     *   submittedAt?: ?string,
     *   paypointName?: ?string,
     *   paypointLegalName?: ?string,
     *   ein?: ?string,
     *   primaryOwnerName?: ?string,
     *   primaryOwnerReference?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->requestsReference = $values['requestsReference'];
        $this->businessReference = $values['businessReference'];
        $this->externalId = $values['externalId'] ?? null;
        $this->parent = $values['parent'] ?? null;
        $this->parentOrgName = $values['parentOrgName'] ?? null;
        $this->entityType = $values['entityType'] ?? null;
        $this->dbaName = $values['dbaName'] ?? null;
        $this->applicationStatus = $values['applicationStatus'];
        $this->applicationStatusCode = $values['applicationStatusCode'];
        $this->allowedActions = $values['allowedActions'];
        $this->requestTemplate = $values['requestTemplate'] ?? null;
        $this->services = $values['services'] ?? null;
        $this->tags = $values['tags'] ?? null;
        $this->representatives = $values['representatives'] ?? null;
        $this->createdAt = $values['createdAt'];
        $this->submittedAt = $values['submittedAt'] ?? null;
        $this->links = $values['links'];
        $this->paypointName = $values['paypointName'] ?? null;
        $this->paypointLegalName = $values['paypointLegalName'] ?? null;
        $this->ein = $values['ein'] ?? null;
        $this->primaryOwnerName = $values['primaryOwnerName'] ?? null;
        $this->primaryOwnerReference = $values['primaryOwnerReference'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
