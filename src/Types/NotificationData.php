<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * Information about the notification or report configuration.
 */
class NotificationData extends JsonSerializableType
{
    /**
     * @var ?NotificationContent $content
     */
    #[JsonProperty('content')]
    public ?NotificationContent $content;

    /**
     * @var ?value-of<Frequencynotification> $frequency
     */
    #[JsonProperty('frequency')]
    public ?string $frequency;

    /**
     * @var value-of<Methodnotification> $method
     */
    #[JsonProperty('method')]
    public string $method;

    /**
     * @var ?string $ownerId
     */
    #[JsonProperty('ownerId')]
    public ?string $ownerId;

    /**
     * @var int $ownerType
     */
    #[JsonProperty('ownerType')]
    public int $ownerType;

    /**
     * @var ?string $source
     */
    #[JsonProperty('source')]
    public ?string $source;

    /**
     * @var ?int $status
     */
    #[JsonProperty('status')]
    public ?int $status;

    /**
     * @var ?string $target
     */
    #[JsonProperty('target')]
    public ?string $target;

    /**
     * @param array{
     *   method: value-of<Methodnotification>,
     *   ownerType: int,
     *   content?: ?NotificationContent,
     *   frequency?: ?value-of<Frequencynotification>,
     *   ownerId?: ?string,
     *   source?: ?string,
     *   status?: ?int,
     *   target?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->content = $values['content'] ?? null;
        $this->frequency = $values['frequency'] ?? null;
        $this->method = $values['method'];
        $this->ownerId = $values['ownerId'] ?? null;
        $this->ownerType = $values['ownerType'];
        $this->source = $values['source'] ?? null;
        $this->status = $values['status'] ?? null;
        $this->target = $values['target'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
