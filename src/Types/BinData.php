<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * Object containing information related to the card. This object is `null` unless the payment method is card. If the payment method is Apple Pay, the binData will be related to the DPAN (device primary account number), not the card connected to Apple Pay.
 */
class BinData extends JsonSerializableType
{
    /**
     * @var ?string $binCardBrand The card brand. For example, Visa, Mastercard, American Express, Discover.
     */
    #[JsonProperty('binCardBrand')]
    public ?string $binCardBrand;

    /**
     * @var ?string $binCardCategory The category of the card, which indicates the card product. For example: Standard, Gold, Platinum, etc. The binCardCategory for prepaid cards is marked `PREPAID`.
     */
    #[JsonProperty('binCardCategory')]
    public ?string $binCardCategory;

    /**
     * @var ?string $binCardIssuer The name of the financial institution that issued the card.
     */
    #[JsonProperty('binCardIssuer')]
    public ?string $binCardIssuer;

    /**
     * @var ?string $binCardIssuerCountry The issuing financial institution's country name.
     */
    #[JsonProperty('binCardIssuerCountry')]
    public ?string $binCardIssuerCountry;

    /**
     * @var ?string $binCardIssuerCountryCodeA2 The issuing financial institution's two-character ISO country code. See [this resource](https://www.iso.org/obp/ui/#search) for a list of codes.
     */
    #[JsonProperty('binCardIssuerCountryCodeA2')]
    public ?string $binCardIssuerCountryCodeA2;

    /**
     * @var ?float $binCardIssuerCountryNumber The issuing financial institution's ISO standard numeric country code. See [this resource](https://www.iso.org/obp/ui/#search) for a list of codes.
     */
    #[JsonProperty('binCardIssuerCountryNumber')]
    public ?float $binCardIssuerCountryNumber;

    /**
     * @var ?string $binCardType The type of card: Credit or Debit.
     */
    #[JsonProperty('binCardType')]
    public ?string $binCardType;

    /**
     * @var ?float $binMatchedLength The number of characters from the beginning of the card number that were matched against a Bank Identification Number (BIN) or the Card Range table.
     */
    #[JsonProperty('binMatchedLength')]
    public ?float $binMatchedLength;

    /**
     * @param array{
     *   binCardBrand?: ?string,
     *   binCardCategory?: ?string,
     *   binCardIssuer?: ?string,
     *   binCardIssuerCountry?: ?string,
     *   binCardIssuerCountryCodeA2?: ?string,
     *   binCardIssuerCountryNumber?: ?float,
     *   binCardType?: ?string,
     *   binMatchedLength?: ?float,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->binCardBrand = $values['binCardBrand'] ?? null;
        $this->binCardCategory = $values['binCardCategory'] ?? null;
        $this->binCardIssuer = $values['binCardIssuer'] ?? null;
        $this->binCardIssuerCountry = $values['binCardIssuerCountry'] ?? null;
        $this->binCardIssuerCountryCodeA2 = $values['binCardIssuerCountryCodeA2'] ?? null;
        $this->binCardIssuerCountryNumber = $values['binCardIssuerCountryNumber'] ?? null;
        $this->binCardType = $values['binCardType'] ?? null;
        $this->binMatchedLength = $values['binMatchedLength'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
