<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Traits\ApplicationCommon;
use Payabli\Core\Json\JsonProperty;

/**
 * A boarding application (request), as returned when you create, get, or update one.
 */
class Application extends JsonSerializableType
{
    use ApplicationCommon;

    /**
     * @var string $paypointReference The reference of the paypoint the application boards.
     */
    #[JsonProperty('paypointReference')]
    public string $paypointReference;

    /**
     * @var string $paypointStatus The status of the paypoint the application boards. New paypoints start in `pending`.
     */
    #[JsonProperty('paypointStatus')]
    public string $paypointStatus;

    /**
     * @param array{
     *   requestsReference: string,
     *   businessReference: string,
     *   applicationStatus: string,
     *   applicationStatusCode: int,
     *   allowedActions: array<string>,
     *   createdAt: string,
     *   links: ApplicationLinks,
     *   paypointReference: string,
     *   paypointStatus: string,
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
        $this->paypointReference = $values['paypointReference'];
        $this->paypointStatus = $values['paypointStatus'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
