<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * A government-issued identification document included in a person request.
 */
class IdentificationDocumentRequest extends JsonSerializableType
{
    /**
     * @var ?string $type The document type, for example `drivers_license`, `passport`, or `state_id`.
     */
    #[JsonProperty('type')]
    public ?string $type;

    /**
     * @var ?string $number The document number.
     */
    #[JsonProperty('number')]
    public ?string $number;

    /**
     * @var ?string $issuingState The two-letter issuing state code.
     */
    #[JsonProperty('issuingState')]
    public ?string $issuingState;

    /**
     * @var ?string $issuingCountry The two-letter ISO 3166-1 alpha-2 issuing country code.
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
