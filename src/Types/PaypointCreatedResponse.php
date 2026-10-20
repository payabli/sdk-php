<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use DateTime;
use Payabli\Core\Types\Date;

/**
 * The reference and initial status of a newly created paypoint.
 */
class PaypointCreatedResponse extends JsonSerializableType
{
    /**
     * @var string $paypointReference The paypoint reference, used to read and manage the paypoint.
     */
    #[JsonProperty('paypointReference')]
    public string $paypointReference;

    /**
     * @var ?string $businessReference The reference of the business the paypoint belongs to.
     */
    #[JsonProperty('businessReference')]
    public ?string $businessReference;

    /**
     * @var ?string $doingBusinessAs The name the paypoint does business as (DBA).
     */
    #[JsonProperty('doingBusinessAs')]
    public ?string $doingBusinessAs;

    /**
     * @var string $paypointStatus The paypoint status. New paypoints start in `pending`.
     */
    #[JsonProperty('paypointStatus')]
    public string $paypointStatus;

    /**
     * @var ?string $timezone The paypoint's time zone.
     */
    #[JsonProperty('timezone')]
    public ?string $timezone;

    /**
     * @var DateTime $createdAt When the paypoint was created.
     */
    #[JsonProperty('createdAt'), Date(Date::TYPE_DATETIME)]
    public DateTime $createdAt;

    /**
     * @var PaypointLinks $links Hypermedia links for the paypoint resource.
     */
    #[JsonProperty('_links')]
    public PaypointLinks $links;

    /**
     * @param array{
     *   paypointReference: string,
     *   paypointStatus: string,
     *   createdAt: DateTime,
     *   links: PaypointLinks,
     *   businessReference?: ?string,
     *   doingBusinessAs?: ?string,
     *   timezone?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->paypointReference = $values['paypointReference'];
        $this->businessReference = $values['businessReference'] ?? null;
        $this->doingBusinessAs = $values['doingBusinessAs'] ?? null;
        $this->paypointStatus = $values['paypointStatus'];
        $this->timezone = $values['timezone'] ?? null;
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
