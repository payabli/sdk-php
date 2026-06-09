<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Core\Types\ArrayType;

class PaypointData extends JsonSerializableType
{
    /**
     * @var ?string $address1
     */
    #[JsonProperty('Address1')]
    public ?string $address1;

    /**
     * @var ?string $address2
     */
    #[JsonProperty('Address2')]
    public ?string $address2;

    /**
     * @var ?array<Bank> $bankData
     */
    #[JsonProperty('BankData'), ArrayType([Bank::class])]
    public ?array $bankData;

    /**
     * @var ?int $boardingId
     */
    #[JsonProperty('BoardingId')]
    public ?int $boardingId;

    /**
     * @var ?string $city
     */
    #[JsonProperty('City')]
    public ?string $city;

    /**
     * @var ?array<Contacts> $contacts
     */
    #[JsonProperty('Contacts'), ArrayType([Contacts::class])]
    public ?array $contacts;

    /**
     * @var ?string $country
     */
    #[JsonProperty('Country')]
    public ?string $country;

    /**
     * @var ?array<PayabliCredentialsPascal> $credentials
     */
    #[JsonProperty('Credentials'), ArrayType([PayabliCredentialsPascal::class])]
    public ?array $credentials;

    /**
     * @var ?string $dbaName
     */
    #[JsonProperty('DbaName')]
    public ?string $dbaName;

    /**
     * @var ?string $externalPaypointId
     */
    #[JsonProperty('externalPaypointID')]
    public ?string $externalPaypointId;

    /**
     * @var ?string $fax Fax number
     */
    #[JsonProperty('Fax')]
    public ?string $fax;

    /**
     * @var ?int $idPaypoint
     */
    #[JsonProperty('IdPaypoint')]
    public ?int $idPaypoint;

    /**
     * @var ?string $legalName
     */
    #[JsonProperty('LegalName')]
    public ?string $legalName;

    /**
     * @var ?OrgData $parentOrg
     */
    #[JsonProperty('ParentOrg')]
    public ?OrgData $parentOrg;

    /**
     * @var ?int $paypointStatus
     */
    #[JsonProperty('PaypointStatus')]
    public ?int $paypointStatus;

    /**
     * @var ?string $phone
     */
    #[JsonProperty('Phone')]
    public ?string $phone;

    /**
     * @var ?Services $serviceData
     */
    #[JsonProperty('ServiceData')]
    public ?Services $serviceData;

    /**
     * @var ?string $state
     */
    #[JsonProperty('State')]
    public ?string $state;

    /**
     * @var ?PaypointSummary $summary
     */
    #[JsonProperty('summary')]
    public ?PaypointSummary $summary;

    /**
     * @var ?int $timeZone
     */
    #[JsonProperty('TimeZone')]
    public ?int $timeZone;

    /**
     * @var ?string $websiteAddress
     */
    #[JsonProperty('WebsiteAddress')]
    public ?string $websiteAddress;

    /**
     * @var ?string $zip
     */
    #[JsonProperty('Zip')]
    public ?string $zip;

    /**
     * @var ?StatementEmailConfig $statementEmail Configuration for billing statement email recipients and sender address. `null` if not configured.
     */
    #[JsonProperty('StatementEmail')]
    public ?StatementEmailConfig $statementEmail;

    /**
     * @param array{
     *   address1?: ?string,
     *   address2?: ?string,
     *   bankData?: ?array<Bank>,
     *   boardingId?: ?int,
     *   city?: ?string,
     *   contacts?: ?array<Contacts>,
     *   country?: ?string,
     *   credentials?: ?array<PayabliCredentialsPascal>,
     *   dbaName?: ?string,
     *   externalPaypointId?: ?string,
     *   fax?: ?string,
     *   idPaypoint?: ?int,
     *   legalName?: ?string,
     *   parentOrg?: ?OrgData,
     *   paypointStatus?: ?int,
     *   phone?: ?string,
     *   serviceData?: ?Services,
     *   state?: ?string,
     *   summary?: ?PaypointSummary,
     *   timeZone?: ?int,
     *   websiteAddress?: ?string,
     *   zip?: ?string,
     *   statementEmail?: ?StatementEmailConfig,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->address1 = $values['address1'] ?? null;
        $this->address2 = $values['address2'] ?? null;
        $this->bankData = $values['bankData'] ?? null;
        $this->boardingId = $values['boardingId'] ?? null;
        $this->city = $values['city'] ?? null;
        $this->contacts = $values['contacts'] ?? null;
        $this->country = $values['country'] ?? null;
        $this->credentials = $values['credentials'] ?? null;
        $this->dbaName = $values['dbaName'] ?? null;
        $this->externalPaypointId = $values['externalPaypointId'] ?? null;
        $this->fax = $values['fax'] ?? null;
        $this->idPaypoint = $values['idPaypoint'] ?? null;
        $this->legalName = $values['legalName'] ?? null;
        $this->parentOrg = $values['parentOrg'] ?? null;
        $this->paypointStatus = $values['paypointStatus'] ?? null;
        $this->phone = $values['phone'] ?? null;
        $this->serviceData = $values['serviceData'] ?? null;
        $this->state = $values['state'] ?? null;
        $this->summary = $values['summary'] ?? null;
        $this->timeZone = $values['timeZone'] ?? null;
        $this->websiteAddress = $values['websiteAddress'] ?? null;
        $this->zip = $values['zip'] ?? null;
        $this->statementEmail = $values['statementEmail'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
