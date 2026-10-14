<?php

namespace Payabli\Traits;

use Payabli\Types\BinData;
use DateTime;
use Payabli\Core\Json\JsonProperty;
use Payabli\Core\Types\Date;

/**
 * Stored payment method information
 *
 * @property ?string $idPmethod
 * @property ?string $method
 * @property ?string $descriptor
 * @property ?string $maskedAccount
 * @property ?string $expDate
 * @property ?string $holderName
 * @property ?string $achSecCode
 * @property ?string $achHolderType
 * @property ?bool $isValidatedAch
 * @property ?string $bin
 * @property ?BinData $binData
 * @property ?string $aba
 * @property ?string $postalCode
 * @property ?string $methodType
 * @property ?string $walletType
 * @property ?DateTime $lastUpdated
 * @property ?DateTime $cardUpdatedOn
 */
trait VendorResponseStoredMethod
{
    /**
     * @var ?string $idPmethod
     */
    #[JsonProperty('IdPmethod')]
    public ?string $idPmethod;

    /**
     * @var ?string $method
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
     * @var ?string $expDate
     */
    #[JsonProperty('ExpDate')]
    public ?string $expDate;

    /**
     * @var ?string $holderName
     */
    #[JsonProperty('HolderName')]
    public ?string $holderName;

    /**
     * @var ?string $achSecCode
     */
    #[JsonProperty('AchSecCode')]
    public ?string $achSecCode;

    /**
     * @var ?string $achHolderType
     */
    #[JsonProperty('AchHolderType')]
    public ?string $achHolderType;

    /**
     * @var ?bool $isValidatedAch
     */
    #[JsonProperty('IsValidatedACH')]
    public ?bool $isValidatedAch;

    /**
     * @var ?string $bin
     */
    #[JsonProperty('BIN')]
    public ?string $bin;

    /**
     * @var ?BinData $binData
     */
    #[JsonProperty('binData')]
    public ?BinData $binData;

    /**
     * @var ?string $aba
     */
    #[JsonProperty('ABA')]
    public ?string $aba;

    /**
     * @var ?string $postalCode
     */
    #[JsonProperty('PostalCode')]
    public ?string $postalCode;

    /**
     * @var ?string $methodType
     */
    #[JsonProperty('MethodType')]
    public ?string $methodType;

    /**
     * @var ?string $walletType Digital wallet type if applicable.
     */
    #[JsonProperty('WalletType')]
    public ?string $walletType;

    /**
     * @var ?DateTime $lastUpdated
     */
    #[JsonProperty('LastUpdated'), Date(Date::TYPE_DATETIME)]
    public ?DateTime $lastUpdated;

    /**
     * @var ?DateTime $cardUpdatedOn Date and time the card was last updated.
     */
    #[JsonProperty('CardUpdatedOn'), Date(Date::TYPE_DATETIME)]
    public ?DateTime $cardUpdatedOn;
}
