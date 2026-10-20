<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use DateTime;
use Payabli\Core\Types\Date;

/**
 * The reference and updated timestamp after a paypoint update.
 */
class PaypointUpdatedResponse extends JsonSerializableType
{
    /**
     * @var string $paypointReference The paypoint reference.
     */
    #[JsonProperty('paypointReference')]
    public string $paypointReference;

    /**
     * @var DateTime $updatedAt When the paypoint was last updated.
     */
    #[JsonProperty('updatedAt'), Date(Date::TYPE_DATETIME)]
    public DateTime $updatedAt;

    /**
     * @var PaypointLinks $links Hypermedia links for the paypoint resource.
     */
    #[JsonProperty('_links')]
    public PaypointLinks $links;

    /**
     * @param array{
     *   paypointReference: string,
     *   updatedAt: DateTime,
     *   links: PaypointLinks,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->paypointReference = $values['paypointReference'];
        $this->updatedAt = $values['updatedAt'];
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
