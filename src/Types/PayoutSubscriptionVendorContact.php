<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * A vendor contact.
 */
class PayoutSubscriptionVendorContact extends JsonSerializableType
{
    /**
     * @var ?string $contactName Contact name.
     */
    #[JsonProperty('contactName')]
    public ?string $contactName;

    /**
     * @var ?string $contactEmail Contact email address.
     */
    #[JsonProperty('contactEmail')]
    public ?string $contactEmail;

    /**
     * @var ?string $contactTitle Contact title.
     */
    #[JsonProperty('contactTitle')]
    public ?string $contactTitle;

    /**
     * @var ?string $contactPhone Contact phone number.
     */
    #[JsonProperty('contactPhone')]
    public ?string $contactPhone;

    /**
     * @param array{
     *   contactName?: ?string,
     *   contactEmail?: ?string,
     *   contactTitle?: ?string,
     *   contactPhone?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->contactName = $values['contactName'] ?? null;
        $this->contactEmail = $values['contactEmail'] ?? null;
        $this->contactTitle = $values['contactTitle'] ?? null;
        $this->contactPhone = $values['contactPhone'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
