<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Traits\VendorResponseStoredMethod;
use Payabli\Core\Json\JsonProperty;
use DateTime;

/**
 * A vendor's stored payment method.
 */
class VendorStoredMethod extends JsonSerializableType
{
    use VendorResponseStoredMethod;

    /**
     * @var ?bool $isDefault When `true`, this payment method is the vendor's default.
     */
    #[JsonProperty('IsDefault')]
    public ?bool $isDefault;

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
     *   isDefault?: ?bool,
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
        $this->isDefault = $values['isDefault'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
