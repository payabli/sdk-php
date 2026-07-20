<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use DateTime;
use Payabli\Core\Types\Date;

class MethodQueryRecords extends JsonSerializableType
{
    /**
     * @var ?string $idPmethod Method internal ID
     */
    #[JsonProperty('IdPmethod')]
    public ?string $idPmethod;

    /**
     * @var ?string $method Type of payment vehicle: **ach** or **card**
     */
    #[JsonProperty('Method')]
    public ?string $method;

    /**
     * @var ?string $descriptor
     */
    #[JsonProperty('Descriptor')]
    public ?string $descriptor;

    /**
     * @var ?string $maskedAccount
     */
    #[JsonProperty('MaskedAccount')]
    public ?string $maskedAccount;

    /**
     * @var ?string $expDate Expiration date associated to the method (only for card) in format MMYY.
     */
    #[JsonProperty('ExpDate')]
    public ?string $expDate;

    /**
     * @var ?string $holderName
     */
    #[JsonProperty('HolderName')]
    public ?string $holderName;

    /**
     * @var ?string $achSecCode Standard Entry Class (SEC) code for the ACH transaction.
     */
    #[JsonProperty('AchSecCode')]
    public ?string $achSecCode;

    /**
     * @var ?string $achHolderType Bank accountholder type: `personal` or `business`.
     */
    #[JsonProperty('AchHolderType')]
    public ?string $achHolderType;

    /**
     * @var ?bool $isValidatedAch Whether the ACH account has been validated.
     */
    #[JsonProperty('IsValidatedACH')]
    public ?bool $isValidatedAch;

    /**
     * @var ?string $bin The bank identification number (BIN). Null when method is ACH.
     */
    #[JsonProperty('BIN')]
    public ?string $bin;

    /**
     * @var ?BinData $binData
     */
    #[JsonProperty('binData')]
    public ?BinData $binData;

    /**
     * @var ?string $aba Bank routing number.
     */
    #[JsonProperty('ABA')]
    public ?string $aba;

    /**
     * @var ?string $postalCode The payment method postal code.
     */
    #[JsonProperty('PostalCode')]
    public ?string $postalCode;

    /**
     * @var ?string $methodType The payment method's token type.
     */
    #[JsonProperty('MethodType')]
    public ?string $methodType;

    /**
     * @var ?string $walletType Digital wallet type if applicable.
     */
    #[JsonProperty('WalletType')]
    public ?string $walletType;

    /**
     * @var ?DateTime $lastUpdated Date of last update
     */
    #[JsonProperty('LastUpdated'), Date(Date::TYPE_DATETIME)]
    public ?DateTime $lastUpdated;

    /**
     * @var ?DateTime $cardUpdatedOn Date and time the card was last updated.
     */
    #[JsonProperty('CardUpdatedOn'), Date(Date::TYPE_DATETIME)]
    public ?DateTime $cardUpdatedOn;

    /**
     * @param array{
     *   idPmethod?: ?string,
     *   method?: ?string,
     *   descriptor?: ?string,
     *   maskedAccount?: ?string,
     *   expDate?: ?string,
     *   holderName?: ?string,
     *   achSecCode?: ?string,
     *   achHolderType?: ?string,
     *   isValidatedAch?: ?bool,
     *   bin?: ?string,
     *   binData?: ?BinData,
     *   aba?: ?string,
     *   postalCode?: ?string,
     *   methodType?: ?string,
     *   walletType?: ?string,
     *   lastUpdated?: ?DateTime,
     *   cardUpdatedOn?: ?DateTime,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->idPmethod = $values['idPmethod'] ?? null;
        $this->method = $values['method'] ?? null;
        $this->descriptor = $values['descriptor'] ?? null;
        $this->maskedAccount = $values['maskedAccount'] ?? null;
        $this->expDate = $values['expDate'] ?? null;
        $this->holderName = $values['holderName'] ?? null;
        $this->achSecCode = $values['achSecCode'] ?? null;
        $this->achHolderType = $values['achHolderType'] ?? null;
        $this->isValidatedAch = $values['isValidatedAch'] ?? null;
        $this->bin = $values['bin'] ?? null;
        $this->binData = $values['binData'] ?? null;
        $this->aba = $values['aba'] ?? null;
        $this->postalCode = $values['postalCode'] ?? null;
        $this->methodType = $values['methodType'] ?? null;
        $this->walletType = $values['walletType'] ?? null;
        $this->lastUpdated = $values['lastUpdated'] ?? null;
        $this->cardUpdatedOn = $values['cardUpdatedOn'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
