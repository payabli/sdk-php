<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use DateTime;
use Payabli\Core\Types\Date;

/**
 * Fields shared by the search and detail responses for a notification log entry.
 */
class NotificationLogBase extends JsonSerializableType
{
    /**
     * @var string $organizationName The name of the organization the notification belongs to.
     */
    #[JsonProperty('organizationName')]
    public string $organizationName;

    /**
     * @var string $paypointName The name of the paypoint the notification is related to. Empty for organization-level notifications.
     */
    #[JsonProperty('paypointName')]
    public string $paypointName;

    /**
     * @var string $requestId The identifier for the delivery request.
     */
    #[JsonProperty('requestId')]
    public string $requestId;

    /**
     * @var string $id The unique identifier for the notification.
     */
    #[JsonProperty('id')]
    public string $id;

    /**
     * @var ?int $orgId The ID of the organization the notification belongs to.
     */
    #[JsonProperty('orgId')]
    public ?int $orgId;

    /**
     * @var ?int $paypointId The ID of the paypoint the notification is related to. Null for organization-level notifications.
     */
    #[JsonProperty('paypointId')]
    public ?int $paypointId;

    /**
     * @var ?string $notificationEvent The event that triggered the notification, such as `approvedpayment`.
     */
    #[JsonProperty('notificationEvent')]
    public ?string $notificationEvent;

    /**
     * @var ?string $target The target the notification was delivered to, such as a webhook URL, email address, or phone number.
     */
    #[JsonProperty('target')]
    public ?string $target;

    /**
     * @var int $responseStatusCode The HTTP status code the target returned, such as `200`. Returns `0` when the target sent no response.
     */
    #[JsonProperty('responseStatusCode')]
    public int $responseStatusCode;

    /**
     * @var string $responseStatus The delivery status message, such as `OK` when the notification succeeded, `Dropped` when it failed, or `No response received from server.` when the target sent no response.
     */
    #[JsonProperty('responseStatus')]
    public string $responseStatus;

    /**
     * @var bool $success Indicates whether the notification was delivered successfully.
     */
    #[JsonProperty('success')]
    public bool $success;

    /**
     * @var ?string $jobData The body of the notification.
     */
    #[JsonProperty('jobData')]
    public ?string $jobData;

    /**
     * @var DateTime $createdDate The date and time when the notification was created.
     */
    #[JsonProperty('createdDate'), Date(Date::TYPE_DATETIME)]
    public DateTime $createdDate;

    /**
     * @var ?DateTime $successDate The date and time when the notification was delivered successfully. Null if it hasn't succeeded.
     */
    #[JsonProperty('successDate'), Date(Date::TYPE_DATETIME)]
    public ?DateTime $successDate;

    /**
     * @var ?DateTime $lastFailedDate The date and time when the notification last failed. Null if it hasn't failed.
     */
    #[JsonProperty('lastFailedDate'), Date(Date::TYPE_DATETIME)]
    public ?DateTime $lastFailedDate;

    /**
     * @var bool $isInProgress Indicates whether the notification is currently being sent.
     */
    #[JsonProperty('isInProgress')]
    public bool $isInProgress;

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
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
