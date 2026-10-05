<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Traits\NotificationLogBase;
use Payabli\Core\Json\JsonProperty;
use DateTime;

/**
 * A notification log entry returned by the search endpoint.
 */
class NotificationLog extends JsonSerializableType
{
    use NotificationLogBase;

    /**
     * @var string $organizationLogo The URL of the organization's logo.
     */
    #[JsonProperty('organizationLogo')]
    public string $organizationLogo;

    /**
     * @var string $organizationFavIcon The URL of the organization's browser tab icon.
     */
    #[JsonProperty('organizationFavIcon')]
    public string $organizationFavIcon;

    /**
     * @var string $paypointLogo The URL of the paypoint's logo.
     */
    #[JsonProperty('paypointLogo')]
    public string $paypointLogo;

    /**
     * @var int $notificationType The notification's delivery method — `1` (Email), `2` (SMS), or `3` (Webhook).
     */
    #[JsonProperty('notificationType')]
    public int $notificationType;

    /**
     * @param array{
     *   organizationName: string,
     *   paypointName: string,
     *   requestId: string,
     *   id: string,
     *   responseStatusCode: int,
     *   responseStatus: string,
     *   success: bool,
     *   createdDate: DateTime,
     *   isInProgress: bool,
     *   organizationLogo: string,
     *   organizationFavIcon: string,
     *   paypointLogo: string,
     *   notificationType: int,
     *   orgId?: ?int,
     *   paypointId?: ?int,
     *   notificationEvent?: ?string,
     *   target?: ?string,
     *   jobData?: ?string,
     *   successDate?: ?DateTime,
     *   lastFailedDate?: ?DateTime,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->organizationName = $values['organizationName'];
        $this->paypointName = $values['paypointName'];
        $this->requestId = $values['requestId'];
        $this->id = $values['id'];
        $this->orgId = $values['orgId'] ?? null;
        $this->paypointId = $values['paypointId'] ?? null;
        $this->notificationEvent = $values['notificationEvent'] ?? null;
        $this->target = $values['target'] ?? null;
        $this->responseStatusCode = $values['responseStatusCode'];
        $this->responseStatus = $values['responseStatus'];
        $this->success = $values['success'];
        $this->jobData = $values['jobData'] ?? null;
        $this->createdDate = $values['createdDate'];
        $this->successDate = $values['successDate'] ?? null;
        $this->lastFailedDate = $values['lastFailedDate'] ?? null;
        $this->isInProgress = $values['isInProgress'];
        $this->organizationLogo = $values['organizationLogo'];
        $this->organizationFavIcon = $values['organizationFavIcon'];
        $this->paypointLogo = $values['paypointLogo'];
        $this->notificationType = $values['notificationType'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
