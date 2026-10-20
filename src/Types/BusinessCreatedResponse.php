<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use DateTime;
use Payabli\Core\Types\Date;

/**
 * The reference and initial status of a newly created business.
 */
class BusinessCreatedResponse extends JsonSerializableType
{
    /**
     * @var string $businessUuid The business reference, used to read and manage the business.
     */
    #[JsonProperty('businessUuid')]
    public string $businessUuid;

    /**
     * @var string $businessStatus The business status. New businesses start in Draft.
     */
    #[JsonProperty('businessStatus')]
    public string $businessStatus;

    /**
     * @var DateTime $createdAt When the business was created.
     */
    #[JsonProperty('createdAt'), Date(Date::TYPE_DATETIME)]
    public DateTime $createdAt;

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
     *   links: BusinessLinks,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->businessUuid = $values['businessUuid'];
        $this->businessStatus = $values['businessStatus'];
        $this->createdAt = $values['createdAt'];
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
