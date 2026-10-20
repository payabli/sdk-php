<?php

namespace Payabli\Paypoints\Requests;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Core\Types\ArrayType;

class UpdatePaypointRequest extends JsonSerializableType
{
    /**
     * @var ?string $paypointType The paypoint type, for example `merchant`.
     */
    #[JsonProperty('paypointType')]
    public ?string $paypointType;

    /**
     * @var ?string $doingBusinessAs The name the paypoint does business as (DBA).
     */
    #[JsonProperty('doingBusinessAs')]
    public ?string $doingBusinessAs;

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

    /**
     * @param array{
     *   paypointType?: ?string,
     *   doingBusinessAs?: ?string,
     *   description?: ?string,
     *   website?: ?string,
     *   customerServicePhone?: ?string,
     *   customerServiceEmail?: ?string,
     *   timezone?: ?string,
     *   externalId?: ?string,
     *   customData?: ?array<string, mixed>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->paypointType = $values['paypointType'] ?? null;
        $this->doingBusinessAs = $values['doingBusinessAs'] ?? null;
        $this->description = $values['description'] ?? null;
        $this->website = $values['website'] ?? null;
        $this->customerServicePhone = $values['customerServicePhone'] ?? null;
        $this->customerServiceEmail = $values['customerServiceEmail'] ?? null;
        $this->timezone = $values['timezone'] ?? null;
        $this->externalId = $values['externalId'] ?? null;
        $this->customData = $values['customData'] ?? null;
    }
}
