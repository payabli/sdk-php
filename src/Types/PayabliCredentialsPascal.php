<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Core\Types\ArrayType;

class PayabliCredentialsPascal extends JsonSerializableType
{
    /**
     * When `true`, the gateway for this credential is enabled for the paypoint. The value is
     * `null` when the credential isn't linked to a gateway.
     *
     * @var ?bool $active
     */
    #[JsonProperty('active')]
    public ?bool $active;

    /**
     * The customer ID configured for this gateway. Returned only for gateways that use a
     * customer ID. For all other gateways, or when no customer ID is configured, the value is
     * `null`.
     *
     * @var ?string $customerId
     */
    #[JsonProperty('customerId')]
    public ?string $customerId;

    /**
     * The client ID configured for this gateway. Returned only for gateways that use a client
     * ID. For all other gateways, or when no client ID is configured, the value is `null`.
     *
     * @var ?string $clientId
     */
    #[JsonProperty('clientId')]
    public ?string $clientId;

    /**
     * @var ?string $service The payment service that this credential applies to. A paypoint can support multiple services, each represented by its own credential object in the array. Possible values are `card` (credit/debit card), `ach` (ACH bank transfer), `check` (paper check), `vcard` (virtual card), `cloud` (card-present), `cash`, `managed` (managed payment service), and `wallet`.
     */
    #[JsonProperty('Service')]
    public ?string $service;

    /**
     * @var ?int $mode The payment mode supported by this service. `0` for one-time payments, `1` for recurring payments, `2` for both.
     */
    #[JsonProperty('Mode')]
    public ?int $mode;

    /**
     * @var ?float $minticket
     */
    #[JsonProperty('Minticket')]
    public ?float $minticket;

    /**
     * @var ?float $maxticket
     */
    #[JsonProperty('Maxticket')]
    public ?float $maxticket;

    /**
     * @var ?float $cfeeFix
     */
    #[JsonProperty('CfeeFix')]
    public ?float $cfeeFix;

    /**
     * @var ?float $cfeeFloat
     */
    #[JsonProperty('CfeeFloat')]
    public ?float $cfeeFloat;

    /**
     * @var ?float $cfeeMin
     */
    #[JsonProperty('CfeeMin')]
    public ?float $cfeeMin;

    /**
     * @var ?float $cfeeMax
     */
    #[JsonProperty('CfeeMax')]
    public ?float $cfeeMax;

    /**
     * @var ?string $accountId The identifier for the payment connector, matching the `accountId` of the linked bank account.
     */
    #[JsonProperty('AccountId')]
    public ?string $accountId;

    /**
     * @var ?int $referenceId
     */
    #[JsonProperty('ReferenceId')]
    public ?int $referenceId;

    /**
     * @var ?bool $acceptSameDayAch
     */
    #[JsonProperty('acceptSameDayACH')]
    public ?bool $acceptSameDayAch;

    /**
     * @var ?array<string> $currency The default currency for the paypoint, either `USD` or `CAD`.
     */
    #[JsonProperty('Currency'), ArrayType(['string'])]
    public ?array $currency;

    /**
     * @var ?bool $greaterValueAllowed
     */
    #[JsonProperty('GreaterValueAllowed')]
    public ?bool $greaterValueAllowed;

    /**
     * @var ?bool $absorbDifference
     */
    #[JsonProperty('AbsorbDifference')]
    public ?bool $absorbDifference;

    /**
     * @var ?bool $allowOverride
     */
    #[JsonProperty('AllowOverride')]
    public ?bool $allowOverride;

    /**
     * @param array{
     *   active?: ?bool,
     *   customerId?: ?string,
     *   clientId?: ?string,
     *   service?: ?string,
     *   mode?: ?int,
     *   minticket?: ?float,
     *   maxticket?: ?float,
     *   cfeeFix?: ?float,
     *   cfeeFloat?: ?float,
     *   cfeeMin?: ?float,
     *   cfeeMax?: ?float,
     *   accountId?: ?string,
     *   referenceId?: ?int,
     *   acceptSameDayAch?: ?bool,
     *   currency?: ?array<string>,
     *   greaterValueAllowed?: ?bool,
     *   absorbDifference?: ?bool,
     *   allowOverride?: ?bool,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->active = $values['active'] ?? null;
        $this->customerId = $values['customerId'] ?? null;
        $this->clientId = $values['clientId'] ?? null;
        $this->service = $values['service'] ?? null;
        $this->mode = $values['mode'] ?? null;
        $this->minticket = $values['minticket'] ?? null;
        $this->maxticket = $values['maxticket'] ?? null;
        $this->cfeeFix = $values['cfeeFix'] ?? null;
        $this->cfeeFloat = $values['cfeeFloat'] ?? null;
        $this->cfeeMin = $values['cfeeMin'] ?? null;
        $this->cfeeMax = $values['cfeeMax'] ?? null;
        $this->accountId = $values['accountId'] ?? null;
        $this->referenceId = $values['referenceId'] ?? null;
        $this->acceptSameDayAch = $values['acceptSameDayAch'] ?? null;
        $this->currency = $values['currency'] ?? null;
        $this->greaterValueAllowed = $values['greaterValueAllowed'] ?? null;
        $this->absorbDifference = $values['absorbDifference'] ?? null;
        $this->allowOverride = $values['allowOverride'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
