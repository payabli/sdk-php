<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use DateTime;
use Payabli\Core\Types\Date;

/**
 * A business as it appears in a list response.
 */
class BusinessSummaryResponse extends JsonSerializableType
{
    /**
     * @var string $businessUuid The business reference.
     */
    #[JsonProperty('businessUuid')]
    public string $businessUuid;

    /**
     * @var ?string $legalName The registered legal name of the business.
     */
    #[JsonProperty('legalName')]
    public ?string $legalName;

    /**
     * @var string $businessStatus The business's current status.
     */
    #[JsonProperty('businessStatus')]
    public string $businessStatus;

    /**
     * @var ?string $parentReference The organization entrypoint the business belongs to.
     */
    #[JsonProperty('parentReference')]
    public ?string $parentReference;

    /**
     * @var DateTime $createdAt When the business was created.
     */
    #[JsonProperty('createdAt'), Date(Date::TYPE_DATETIME)]
    public DateTime $createdAt;

    /**
     * @var DateTime $lastUpdated When the business was last updated.
     */
    #[JsonProperty('lastUpdated'), Date(Date::TYPE_DATETIME)]
    public DateTime $lastUpdated;

    /**
     * @var BusinessLinks $links Hypermedia links for the business resource.
     */
    #[JsonProperty('_links')]
    public BusinessLinks $links;

    /**
     * @param array{
     *   businessUuid: string,
     *   businessStatus: string,
     *   createdAt: DateTime,
     *   lastUpdated: DateTime,
     *   links: BusinessLinks,
     *   legalName?: ?string,
     *   parentReference?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->businessUuid = $values['businessUuid'];
        $this->legalName = $values['legalName'] ?? null;
        $this->businessStatus = $values['businessStatus'];
        $this->parentReference = $values['parentReference'] ?? null;
        $this->createdAt = $values['createdAt'];
        $this->lastUpdated = $values['lastUpdated'];
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
