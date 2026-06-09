<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Core\Types\ArrayType;

class NotificationRequest extends JsonSerializableType
{
    /**
     * @var string $notificationUrl Complete HTTP URL receiving the notification
     */
    #[JsonProperty('notificationUrl')]
    public string $notificationUrl;

    /**
     * @var ?array<WebHeaderParameter> $webHeaderParameters List of key-value header parameters to include in the notification request
     */
    #[JsonProperty('webHeaderParameters'), ArrayType([WebHeaderParameter::class])]
    public ?array $webHeaderParameters;

    /**
     * @param array{
     *   notificationUrl: string,
     *   webHeaderParameters?: ?array<WebHeaderParameter>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->notificationUrl = $values['notificationUrl'];
        $this->webHeaderParameters = $values['webHeaderParameters'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
