<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use DateTime;
use Payabli\Core\Types\Date;

/**
 * The reference and updated timestamp after a business update.
 */
class BusinessUpdatedResponse extends JsonSerializableType
{
    /**
     * @var string $businessUuid The business reference.
     */
    #[JsonProperty('businessUuid')]
    public string $businessUuid;

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
     *   lastUpdated: DateTime,
     *   links: BusinessLinks,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->businessUuid = $values['businessUuid'];
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
