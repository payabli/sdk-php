<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

class ContactsResponse extends JsonSerializableType
{
    /**
     * @var ?string $contactName Contact name.
     */
    #[JsonProperty('ContactName')]
    public ?string $contactName;

    /**
     * @var ?string $contactEmail Contact email address.
     */
    #[JsonProperty('ContactEmail')]
    public ?string $contactEmail;

    /**
     * @var ?string $contactTitle Contact title.
     */
    #[JsonProperty('ContactTitle')]
    public ?string $contactTitle;

    /**
     * @var ?string $contactPhone Contact phone number.
     */
    #[JsonProperty('ContactPhone')]
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
