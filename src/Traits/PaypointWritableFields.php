<?php

namespace Payabli\Traits;

use Payabli\Core\Json\JsonProperty;
use Payabli\Core\Types\ArrayType;

/**
 * Fields you can set when you create a paypoint.
 *
 * @property ?string $parentPaypointReference
 * @property ?string $paypointType
 * @property string $doingBusinessAs
 * @property ?string $description
 * @property ?string $website
 * @property ?string $customerServicePhone
 * @property ?string $customerServiceEmail
 * @property ?string $timezone
 * @property ?string $externalId
 * @property ?array<string, mixed> $customData
 */
trait PaypointWritableFields
{
    /**
     * @var ?string $parentPaypointReference The reference of the parent paypoint, for a paypoint that nests under another.
     */
    #[JsonProperty('parentPaypointReference')]
    public ?string $parentPaypointReference;

    /**
     * @var ?string $paypointType The paypoint type, for example `merchant`.
     */
    #[JsonProperty('paypointType')]
    public ?string $paypointType;

    /**
     * @var string $doingBusinessAs The name the paypoint does business as (DBA).
     */
    #[JsonProperty('doingBusinessAs')]
    public string $doingBusinessAs;

    /**
     * @var ?string $description A free-text description of the paypoint.
     */
    #[JsonProperty('description')]
    public ?string $description;

    /**
     * @var ?string $website The paypoint's website URL.
     */
    #[JsonProperty('website')]
    public ?string $website;

    /**
     * @var ?string $customerServicePhone The customer service phone number.
     */
    #[JsonProperty('customerServicePhone')]
    public ?string $customerServicePhone;

    /**
     * @var ?string $customerServiceEmail The customer service email address.
     */
    #[JsonProperty('customerServiceEmail')]
    public ?string $customerServiceEmail;

    /**
     * @var ?string $timezone The paypoint's time zone.
     */
    #[JsonProperty('timezone')]
    public ?string $timezone;

    /**
     * @var ?string $externalId Your own identifier for the paypoint.
     */
    #[JsonProperty('externalId')]
    public ?string $externalId;

    /**
     * @var ?array<string, mixed> $customData Arbitrary key-value data you attach to the paypoint.
     */
    #[JsonProperty('customData'), ArrayType(['string' => 'mixed'])]
    public ?array $customData;
}
