<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use DateTime;
use Payabli\Core\Types\Date;

/**
 * The result of removing a business address.
 */
class BusinessAddressDeletedResponse extends JsonSerializableType
{
    /**
     * @var BusinessLinks $links Hypermedia links for the business resource.
     */
    #[JsonProperty('_links')]
    public BusinessLinks $links;

    /**
     * @var string $businessUuid The business reference.
     */
    #[JsonProperty('businessUuid')]
    public string $businessUuid;

    /**
     * @var string $businessAddressReference The reference of the removed business address.
     */
    #[JsonProperty('businessAddressReference')]
    public string $businessAddressReference;

    /**
     * @var DateTime $deletedAt When the address was removed.
     */
    #[JsonProperty('deletedAt'), Date(Date::TYPE_DATETIME)]
    public DateTime $deletedAt;

    /**
     * @param array{
     *   links: BusinessLinks,
     *   businessUuid: string,
     *   businessAddressReference: string,
     *   deletedAt: DateTime,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->links = $values['links'];
        $this->businessUuid = $values['businessUuid'];
        $this->businessAddressReference = $values['businessAddressReference'];
        $this->deletedAt = $values['deletedAt'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
