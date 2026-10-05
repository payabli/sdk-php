<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Traits\NotificationLogBase;
use Payabli\Core\Json\JsonProperty;
use Payabli\Core\Types\ArrayType;
use DateTime;

/**
 * A notification log entry returned by the detail and retry endpoints, including the request and response captured for the delivery.
 */
class NotificationLogDetail extends JsonSerializableType
{
    use NotificationLogBase;

    /**
     * @var ?array<StringStringKeyValuePair> $webHeaders The custom headers Payabli sent with the notification, if any.
     */
    #[JsonProperty('webHeaders'), ArrayType([StringStringKeyValuePair::class])]
    public ?array $webHeaders;

    /**
     * @var ?array<KeyValueArray> $responseHeaders The headers the target returned. Null when the target sent no response.
     */
    #[JsonProperty('responseHeaders'), ArrayType([KeyValueArray::class])]
    public ?array $responseHeaders;

    /**
     * @var string $responseContent The body the target returned. Empty when the target sent no response.
     */
    #[JsonProperty('responseContent')]
    public string $responseContent;

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
     *   responseContent: string,
     *   orgId?: ?int,
     *   paypointId?: ?int,
     *   notificationEvent?: ?string,
     *   target?: ?string,
     *   jobData?: ?string,
     *   successDate?: ?DateTime,
     *   lastFailedDate?: ?DateTime,
     *   webHeaders?: ?array<StringStringKeyValuePair>,
     *   responseHeaders?: ?array<KeyValueArray>,
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
        $this->webHeaders = $values['webHeaders'] ?? null;
        $this->responseHeaders = $values['responseHeaders'] ?? null;
        $this->responseContent = $values['responseContent'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
