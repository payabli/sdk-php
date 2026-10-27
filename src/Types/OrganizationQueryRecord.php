<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Core\Types\ArrayType;
use DateTime;
use Payabli\Core\Types\Date;

class OrganizationQueryRecord extends JsonSerializableType
{
    /**
     * @var ?InstrumentResponse $billingInfo
     */
    #[JsonProperty('BillingInfo')]
    public ?InstrumentResponse $billingInfo;

    /**
     * @var ?array<ContactsResponse> $contacts List of contacts.
     */
    #[JsonProperty('Contacts'), ArrayType([ContactsResponse::class])]
    public ?array $contacts;

    /**
     * @var ?DateTime $createdAt
     */
    #[JsonProperty('createdAt'), Date(Date::TYPE_DATETIME)]
    public ?DateTime $createdAt;

    /**
     * @var ?bool $hasBilling
     */
    #[JsonProperty('HasBilling')]
    public ?bool $hasBilling;

    /**
     * @var ?bool $hasResidual
     */
    #[JsonProperty('HasResidual')]
    public ?bool $hasResidual;

    /**
     * @var ?int $idOrg
     */
    #[JsonProperty('idOrg')]
    public ?int $idOrg;

    /**
     * @var ?bool $isRoot
     */
    #[JsonProperty('isRoot')]
    public ?bool $isRoot;

    /**
     * @var ?string $orgAddress
     */
    #[JsonProperty('OrgAddress')]
    public ?string $orgAddress;

    /**
     * @var ?string $orgCity
     */
    #[JsonProperty('OrgCity')]
    public ?string $orgCity;

    /**
     * @var ?string $orgCountry
     */
    #[JsonProperty('OrgCountry')]
    public ?string $orgCountry;

    /**
     * @var ?string $orgEntryName
     */
    #[JsonProperty('OrgEntryName')]
    public ?string $orgEntryName;

    /**
     * @var ?string $orgFavicon URL of the organization's favicon.
     */
    #[JsonProperty('OrgFavicon')]
    public ?string $orgFavicon;

    /**
     * @var ?string $orgId
     */
    #[JsonProperty('OrgId')]
    public ?string $orgId;

    /**
     * @var ?string $orgLogo URL of the organization's logo.
     */
    #[JsonProperty('OrgLogo')]
    public ?string $orgLogo;

    /**
     * @var ?string $orgName
     */
    #[JsonProperty('OrgName')]
    public ?string $orgName;

    /**
     * @var ?int $orgParentId
     */
    #[JsonProperty('OrgParentId')]
    public ?int $orgParentId;

    /**
     * @var ?string $orgParentName
     */
    #[JsonProperty('OrgParentName')]
    public ?string $orgParentName;

    /**
     * @var ?string $orgState
     */
    #[JsonProperty('OrgState')]
    public ?string $orgState;

    /**
     * @var ?int $orgTimezone
     */
    #[JsonProperty('OrgTimezone')]
    public ?int $orgTimezone;

    /**
     * @var ?int $orgType
     */
    #[JsonProperty('OrgType')]
    public ?int $orgType;

    /**
     * @var ?string $orgWebsite
     */
    #[JsonProperty('OrgWebsite')]
    public ?string $orgWebsite;

    /**
     * @var ?string $orgZip
     */
    #[JsonProperty('OrgZip')]
    public ?string $orgZip;

    /**
     * @var ?bool $recipientEmailNotification
     */
    #[JsonProperty('recipientEmailNotification')]
    public ?bool $recipientEmailNotification;

    /**
     * @var ?string $replyToEmail
     */
    #[JsonProperty('ReplyToEmail')]
    public ?string $replyToEmail;

    /**
     * @var ?bool $resumable
     */
    #[JsonProperty('resumable')]
    public ?bool $resumable;

    /**
     * @var ?array<OrganizationQueryRecordServicesItem> $services
     */
    #[JsonProperty('Services'), ArrayType([OrganizationQueryRecordServicesItem::class])]
    public ?array $services;

    /**
     * @var ?SummaryOrg $summary
     */
    #[JsonProperty('summary')]
    public ?SummaryOrg $summary;

    /**
     * @var ?array<UserQueryRecord> $users
     */
    #[JsonProperty('users'), ArrayType([UserQueryRecord::class])]
    public ?array $users;

    /**
     * @param array{
     *   billingInfo?: ?InstrumentResponse,
     *   contacts?: ?array<ContactsResponse>,
     *   createdAt?: ?DateTime,
     *   hasBilling?: ?bool,
     *   hasResidual?: ?bool,
     *   idOrg?: ?int,
     *   isRoot?: ?bool,
     *   orgAddress?: ?string,
     *   orgCity?: ?string,
     *   orgCountry?: ?string,
     *   orgEntryName?: ?string,
     *   orgFavicon?: ?string,
     *   orgId?: ?string,
     *   orgLogo?: ?string,
     *   orgName?: ?string,
     *   orgParentId?: ?int,
     *   orgParentName?: ?string,
     *   orgState?: ?string,
     *   orgTimezone?: ?int,
     *   orgType?: ?int,
     *   orgWebsite?: ?string,
     *   orgZip?: ?string,
     *   recipientEmailNotification?: ?bool,
     *   replyToEmail?: ?string,
     *   resumable?: ?bool,
     *   services?: ?array<OrganizationQueryRecordServicesItem>,
     *   summary?: ?SummaryOrg,
     *   users?: ?array<UserQueryRecord>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->billingInfo = $values['billingInfo'] ?? null;
        $this->contacts = $values['contacts'] ?? null;
        $this->createdAt = $values['createdAt'] ?? null;
        $this->hasBilling = $values['hasBilling'] ?? null;
        $this->hasResidual = $values['hasResidual'] ?? null;
        $this->idOrg = $values['idOrg'] ?? null;
        $this->isRoot = $values['isRoot'] ?? null;
        $this->orgAddress = $values['orgAddress'] ?? null;
        $this->orgCity = $values['orgCity'] ?? null;
        $this->orgCountry = $values['orgCountry'] ?? null;
        $this->orgEntryName = $values['orgEntryName'] ?? null;
        $this->orgFavicon = $values['orgFavicon'] ?? null;
        $this->orgId = $values['orgId'] ?? null;
        $this->orgLogo = $values['orgLogo'] ?? null;
        $this->orgName = $values['orgName'] ?? null;
        $this->orgParentId = $values['orgParentId'] ?? null;
        $this->orgParentName = $values['orgParentName'] ?? null;
        $this->orgState = $values['orgState'] ?? null;
        $this->orgTimezone = $values['orgTimezone'] ?? null;
        $this->orgType = $values['orgType'] ?? null;
        $this->orgWebsite = $values['orgWebsite'] ?? null;
        $this->orgZip = $values['orgZip'] ?? null;
        $this->recipientEmailNotification = $values['recipientEmailNotification'] ?? null;
        $this->replyToEmail = $values['replyToEmail'] ?? null;
        $this->resumable = $values['resumable'] ?? null;
        $this->services = $values['services'] ?? null;
        $this->summary = $values['summary'] ?? null;
        $this->users = $values['users'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
