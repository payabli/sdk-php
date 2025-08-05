<?php

namespace Payabli\Organization\Requests;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Types\ServiceCost;
use Payabli\Core\Json\JsonProperty;
use Payabli\Core\Types\ArrayType;
use Payabli\Types\Instrument;
use Payabli\Types\Contacts;
use Payabli\Types\FileContent;

class AddOrganizationRequest extends JsonSerializableType
{
    /**
     * @var ?string $idempotencyKey A unique ID you can include to prevent duplicating objects or transactions if a request is sent more than once. This key isn't generated in Payabli, you must generate it yourself.
     */
    public ?string $idempotencyKey;

    /**
     * @var ?array<ServiceCost> $services
     */
    #[JsonProperty('services'), ArrayType([ServiceCost::class])]
    public ?array $services;

    /**
     * @var ?Instrument $billingInfo
     */
    #[JsonProperty('billingInfo')]
    public ?Instrument $billingInfo;

    /**
     * @var ?array<Contacts> $contacts
     */
    #[JsonProperty('contacts'), ArrayType([Contacts::class])]
    public ?array $contacts;

    /**
     * @var ?bool $hasBilling
     */
    #[JsonProperty('hasBilling')]
    public ?bool $hasBilling;

    /**
     * @var ?bool $hasResidual
     */
    #[JsonProperty('hasResidual')]
    public ?bool $hasResidual;

    /**
     * @var ?string $orgAddress
     */
    #[JsonProperty('orgAddress')]
    public ?string $orgAddress;

    /**
     * @var ?string $orgCity
     */
    #[JsonProperty('orgCity')]
    public ?string $orgCity;

    /**
     * @var ?string $orgCountry
     */
    #[JsonProperty('orgCountry')]
    public ?string $orgCountry;

    /**
     * @var ?string $orgEntryName
     */
    #[JsonProperty('orgEntryName')]
    public ?string $orgEntryName;

    /**
     * @var ?string $orgId
     */
    #[JsonProperty('orgId')]
    public ?string $orgId;

    /**
     * @var ?FileContent $orgLogo
     */
    #[JsonProperty('orgLogo')]
    public ?FileContent $orgLogo;

    /**
     * @var string $orgName
     */
    #[JsonProperty('orgName')]
    public string $orgName;

    /**
     * @var ?int $orgParentId
     */
    #[JsonProperty('orgParentId')]
    public ?int $orgParentId;

    /**
     * @var ?string $orgState
     */
    #[JsonProperty('orgState')]
    public ?string $orgState;

    /**
     * @var ?int $orgTimezone
     */
    #[JsonProperty('orgTimezone')]
    public ?int $orgTimezone;

    /**
     * @var int $orgType
     */
    #[JsonProperty('orgType')]
    public int $orgType;

    /**
     * @var ?string $orgWebsite
     */
    #[JsonProperty('orgWebsite')]
    public ?string $orgWebsite;

    /**
     * @var ?string $orgZip
     */
    #[JsonProperty('orgZip')]
    public ?string $orgZip;

    /**
     * @var string $replyToEmail
     */
    #[JsonProperty('replyToEmail')]
    public string $replyToEmail;

    /**
     * @param array{
     *   orgName: string,
     *   orgType: int,
     *   replyToEmail: string,
     *   idempotencyKey?: ?string,
     *   services?: ?array<ServiceCost>,
     *   billingInfo?: ?Instrument,
     *   contacts?: ?array<Contacts>,
     *   hasBilling?: ?bool,
     *   hasResidual?: ?bool,
     *   orgAddress?: ?string,
     *   orgCity?: ?string,
     *   orgCountry?: ?string,
     *   orgEntryName?: ?string,
     *   orgId?: ?string,
     *   orgLogo?: ?FileContent,
     *   orgParentId?: ?int,
     *   orgState?: ?string,
     *   orgTimezone?: ?int,
     *   orgWebsite?: ?string,
     *   orgZip?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->idempotencyKey = $values['idempotencyKey'] ?? null;
        $this->services = $values['services'] ?? null;
        $this->billingInfo = $values['billingInfo'] ?? null;
        $this->contacts = $values['contacts'] ?? null;
        $this->hasBilling = $values['hasBilling'] ?? null;
        $this->hasResidual = $values['hasResidual'] ?? null;
        $this->orgAddress = $values['orgAddress'] ?? null;
        $this->orgCity = $values['orgCity'] ?? null;
        $this->orgCountry = $values['orgCountry'] ?? null;
        $this->orgEntryName = $values['orgEntryName'] ?? null;
        $this->orgId = $values['orgId'] ?? null;
        $this->orgLogo = $values['orgLogo'] ?? null;
        $this->orgName = $values['orgName'];
        $this->orgParentId = $values['orgParentId'] ?? null;
        $this->orgState = $values['orgState'] ?? null;
        $this->orgTimezone = $values['orgTimezone'] ?? null;
        $this->orgType = $values['orgType'];
        $this->orgWebsite = $values['orgWebsite'] ?? null;
        $this->orgZip = $values['orgZip'] ?? null;
        $this->replyToEmail = $values['replyToEmail'];
    }
}
