<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * A government-issued identification document in a person response.
 */
class IdentificationDocumentResponse extends JsonSerializableType
{
    /**
     * @var ?string $type The document type, for example `passport` or `drivers_license`.
     */
    #[JsonProperty('type')]
    public ?string $type;

    /**
     * @var ?string $number The document number. Masked on standard reads; read the unmasked endpoint for the raw value.
     */
    #[JsonProperty('number')]
    public ?string $number;

    /**
     * @var ?string $issuingState The two-letter issuing state code.
     */
    #[JsonProperty('issuingState')]
    public ?string $issuingState;

    /**
     * @var ?string $issuingCountry The two-letter issuing country code.
     */
    #[JsonProperty('issuingCountry')]
    public ?string $issuingCountry;

    /**
     * @var ?string $expirationDate The document expiration date.
     */
    #[JsonProperty('expirationDate')]
    public ?string $expirationDate;

    /**
     * @param array{
     *   type?: ?string,
     *   number?: ?string,
     *   issuingState?: ?string,
     *   issuingCountry?: ?string,
     *   expirationDate?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->type = $values['type'] ?? null;
        $this->number = $values['number'] ?? null;
        $this->issuingState = $values['issuingState'] ?? null;
        $this->issuingCountry = $values['issuingCountry'] ?? null;
        $this->expirationDate = $values['expirationDate'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
