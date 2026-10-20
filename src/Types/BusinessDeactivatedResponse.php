<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use DateTime;
use Payabli\Core\Types\Date;

/**
 * The result of deactivating a business.
 */
class BusinessDeactivatedResponse extends JsonSerializableType
{
    /**
     * @var string $businessUuid The business reference.
     */
    #[JsonProperty('businessUuid')]
    public string $businessUuid;

    /**
     * @var string $businessStatus The business status after deactivation (Deactivated).
     */
    #[JsonProperty('businessStatus')]
    public string $businessStatus;

    /**
     * @var DateTime $deactivatedAt When the business was deactivated.
     */
    #[JsonProperty('deactivatedAt'), Date(Date::TYPE_DATETIME)]
    public DateTime $deactivatedAt;

    /**
     * @var ?string $reason The reason recorded for the deactivation.
     */
    #[JsonProperty('reason')]
    public ?string $reason;

    /**
     * @var BusinessLinks $links Hypermedia links for the business resource.
     */
    #[JsonProperty('_links')]
    public BusinessLinks $links;

    /**
     * @param array{
     *   businessUuid: string,
     *   businessStatus: string,
     *   deactivatedAt: DateTime,
     *   links: BusinessLinks,
     *   reason?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->businessUuid = $values['businessUuid'];
        $this->businessStatus = $values['businessStatus'];
        $this->deactivatedAt = $values['deactivatedAt'];
        $this->reason = $values['reason'] ?? null;
        $this->links = $values['links'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
