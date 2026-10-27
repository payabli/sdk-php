<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * The organization's billing information. Fields that aren't set return `null`.
 */
class InstrumentResponse extends JsonSerializableType
{
    /**
     * @var ?string $achAccount Bank account number, masked.
     */
    #[JsonProperty('achAccount')]
    public ?string $achAccount;

    /**
     * @var ?string $achRouting ABA/routing number of bank account.
     */
    #[JsonProperty('achRouting')]
    public ?string $achRouting;

    /**
     * @var ?string $billingAddress Billing address.
     */
    #[JsonProperty('billingAddress')]
    public ?string $billingAddress;

    /**
     * @var ?string $billingCity Billing city.
     */
    #[JsonProperty('billingCity')]
    public ?string $billingCity;

    /**
     * @var ?string $billingCountry Billing address country.
     */
    #[JsonProperty('billingCountry')]
    public ?string $billingCountry;

    /**
     * @var ?string $billingState Billing state.
     */
    #[JsonProperty('billingState')]
    public ?string $billingState;

    /**
     * @var ?string $billingZip Billing address ZIP code.
     */
    #[JsonProperty('billingZip')]
    public ?string $billingZip;

    /**
     * @param array{
     *   achAccount?: ?string,
     *   achRouting?: ?string,
     *   billingAddress?: ?string,
     *   billingCity?: ?string,
     *   billingCountry?: ?string,
     *   billingState?: ?string,
     *   billingZip?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->achAccount = $values['achAccount'] ?? null;
        $this->achRouting = $values['achRouting'] ?? null;
        $this->billingAddress = $values['billingAddress'] ?? null;
        $this->billingCity = $values['billingCity'] ?? null;
        $this->billingCountry = $values['billingCountry'] ?? null;
        $this->billingState = $values['billingState'] ?? null;
        $this->billingZip = $values['billingZip'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
