<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Core\Types\ArrayType;
use DateTime;
use Payabli\Core\Types\Date;

class VendorQueryRecord extends JsonSerializableType
{
    /**
     * @var ?string $vendorNumber
     */
    #[JsonProperty('VendorNumber')]
    public ?string $vendorNumber;

    /**
     * @var ?string $name1
     */
    #[JsonProperty('Name1')]
    public ?string $name1;

    /**
     * @var ?string $name2
     */
    #[JsonProperty('Name2')]
    public ?string $name2;

    /**
     * @var ?string $ein
     */
    #[JsonProperty('EIN')]
    public ?string $ein;

    /**
     * @var ?string $phone
     */
    #[JsonProperty('Phone')]
    public ?string $phone;

    /**
     * @var ?string $email
     */
    #[JsonProperty('Email')]
    public ?string $email;

    /**
     * @var ?string $remitEmail
     */
    #[JsonProperty('RemitEmail')]
    public ?string $remitEmail;

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
     * @var ?string $city
     */
    #[JsonProperty('City')]
    public ?string $city;

    /**
     * @var ?string $state
     */
    #[JsonProperty('State')]
    public ?string $state;

    /**
     * @var ?string $zip
     */
    #[JsonProperty('Zip')]
    public ?string $zip;

    /**
     * @var ?string $country
     */
    #[JsonProperty('Country')]
    public ?string $country;

    /**
     * @var ?string $mcc
     */
    #[JsonProperty('Mcc')]
    public ?string $mcc;

    /**
     * @var ?string $locationCode
     */
    #[JsonProperty('LocationCode')]
    public ?string $locationCode;

    /**
     * @var ?array<ContactsResponse> $contacts Array of objects describing the vendor's contacts.
     */
    #[JsonProperty('Contacts'), ArrayType([ContactsResponse::class])]
    public ?array $contacts;

    /**
     * @var ?BillingDataResponse $billingData
     */
    #[JsonProperty('BillingData')]
    public ?BillingDataResponse $billingData;

    /**
     * @var ?string $paymentMethod
     */
    #[JsonProperty('PaymentMethod')]
    public ?string $paymentMethod;

    /**
     * @var ?int $vendorStatus
     */
    #[JsonProperty('VendorStatus')]
    public ?int $vendorStatus;

    /**
     * @var ?int $vendorId
     */
    #[JsonProperty('VendorId')]
    public ?int $vendorId;

    /**
     * @var ?string $enrollmentStatus
     */
    #[JsonProperty('EnrollmentStatus')]
    public ?string $enrollmentStatus;

    /**
     * @var ?VendorSummary $summary
     */
    #[JsonProperty('Summary')]
    public ?VendorSummary $summary;

    /**
     * @var ?string $paypointLegalname
     */
    #[JsonProperty('PaypointLegalname')]
    public ?string $paypointLegalname;

    /**
     * @var ?int $paypointId The paypoint's ID. This is different from the entryname.
     */
    #[JsonProperty('PaypointId')]
    public ?int $paypointId;

    /**
     * @var ?string $paypointDbaname
     */
    #[JsonProperty('PaypointDbaname')]
    public ?string $paypointDbaname;

    /**
     * @var ?string $paypointEntryname
     */
    #[JsonProperty('PaypointEntryname')]
    public ?string $paypointEntryname;

    /**
     * @var ?string $parentOrgName
     */
    #[JsonProperty('ParentOrgName')]
    public ?string $parentOrgName;

    /**
     * @var ?int $parentOrgId
     */
    #[JsonProperty('ParentOrgId')]
    public ?int $parentOrgId;

    /**
     * @var ?DateTime $createdDate
     */
    #[JsonProperty('CreatedDate'), Date(Date::TYPE_DATETIME)]
    public ?DateTime $createdDate;

    /**
     * @var ?DateTime $lastUpdated
     */
    #[JsonProperty('LastUpdated'), Date(Date::TYPE_DATETIME)]
    public ?DateTime $lastUpdated;

    /**
     * @var ?string $remitAddress1
     */
    #[JsonProperty('remitAddress1')]
    public ?string $remitAddress1;

    /**
     * @var ?string $remitAddress2
     */
    #[JsonProperty('remitAddress2')]
    public ?string $remitAddress2;

    /**
     * @var ?string $remitCity
     */
    #[JsonProperty('remitCity')]
    public ?string $remitCity;

    /**
     * @var ?string $remitState
     */
    #[JsonProperty('remitState')]
    public ?string $remitState;

    /**
     * @var ?string $remitZip
     */
    #[JsonProperty('remitZip')]
    public ?string $remitZip;

    /**
     * @var ?string $remitCountry
     */
    #[JsonProperty('remitCountry')]
    public ?string $remitCountry;

    /**
     * @var ?string $payeeName1
     */
    #[JsonProperty('payeeName1')]
    public ?string $payeeName1;

    /**
     * @var ?string $payeeName2
     */
    #[JsonProperty('payeeName2')]
    public ?string $payeeName2;

    /**
     * @var ?string $customField1
     */
    #[JsonProperty('customField1')]
    public ?string $customField1;

    /**
     * @var ?string $customField2
     */
    #[JsonProperty('customField2')]
    public ?string $customField2;

    /**
     * @var ?string $customerVendorAccount
     */
    #[JsonProperty('customerVendorAccount')]
    public ?string $customerVendorAccount;

    /**
     * @var ?int $internalReferenceId
     */
    #[JsonProperty('InternalReferenceId')]
    public ?int $internalReferenceId;

    /**
     * @var ?string $paymentPortalUrl URL for the vendor's online payment portal, if known. Populated by the vendor enrichment pipeline.
     */
    #[JsonProperty('PaymentPortalUrl')]
    public ?string $paymentPortalUrl;

    /**
     * @var ?string $cardAccepted Whether the vendor accepts card payments. Values are `yes`, `no`, or `unable to determine`. Populated by the vendor enrichment pipeline.
     */
    #[JsonProperty('CardAccepted')]
    public ?string $cardAccepted;

    /**
     * @var ?string $achAccepted Whether the vendor accepts ACH payments. Values are `yes`, `no`, or `unable to determine`. Populated by the vendor enrichment pipeline.
     */
    #[JsonProperty('AchAccepted')]
    public ?string $achAccepted;

    /**
     * @var ?string $checkAccepted Whether the vendor accepts check payments. Values are `yes`, `no`, or `unable to determine`. Populated by the vendor enrichment pipeline.
     */
    #[JsonProperty('CheckAccepted')]
    public ?string $checkAccepted;

    /**
     * @var ?string $enrichmentStatus Current enrichment state of the vendor. Values are `not_enriched`, `partially_enriched`, `fully_enriched`, or `fallback_applied`.
     */
    #[JsonProperty('EnrichmentStatus')]
    public ?string $enrichmentStatus;

    /**
     * @var ?string $enrichedBy Which enrichment method resolved the vendor's payment acceptance info. Values are `invoice_scan`, `web_search`, `vendor_network`, or `manual`.
     */
    #[JsonProperty('EnrichedBy')]
    public ?string $enrichedBy;

    /**
     * @var ?DateTime $enrichedAt When the vendor was last enriched (UTC).
     */
    #[JsonProperty('EnrichedAt'), Date(Date::TYPE_DATETIME)]
    public ?DateTime $enrichedAt;

    /**
     * @var ?string $enrichmentId Identifier for the enrichment request that last updated this vendor.
     */
    #[JsonProperty('EnrichmentId')]
    public ?string $enrichmentId;

    /**
     * @var ?array<string, array<string, mixed>> $additionalData
     */
    #[JsonProperty('additionalData'), ArrayType(['string' => ['string' => 'mixed']])]
    public ?array $additionalData;

    /**
     * @var ?string $externalPaypointId
     */
    #[JsonProperty('externalPaypointID')]
    public ?string $externalPaypointId;

    /**
     * @var ?array<VendorResponseStoredMethod> $storedMethods
     */
    #[JsonProperty('StoredMethods'), ArrayType([VendorResponseStoredMethod::class])]
    public ?array $storedMethods;

    /**
     * @param array{
     *   vendorNumber?: ?string,
     *   name1?: ?string,
     *   name2?: ?string,
     *   ein?: ?string,
     *   phone?: ?string,
     *   email?: ?string,
     *   remitEmail?: ?string,
     *   address1?: ?string,
     *   address2?: ?string,
     *   city?: ?string,
     *   state?: ?string,
     *   zip?: ?string,
     *   country?: ?string,
     *   mcc?: ?string,
     *   locationCode?: ?string,
     *   contacts?: ?array<ContactsResponse>,
     *   billingData?: ?BillingDataResponse,
     *   paymentMethod?: ?string,
     *   vendorStatus?: ?int,
     *   vendorId?: ?int,
     *   enrollmentStatus?: ?string,
     *   summary?: ?VendorSummary,
     *   paypointLegalname?: ?string,
     *   paypointId?: ?int,
     *   paypointDbaname?: ?string,
     *   paypointEntryname?: ?string,
     *   parentOrgName?: ?string,
     *   parentOrgId?: ?int,
     *   createdDate?: ?DateTime,
     *   lastUpdated?: ?DateTime,
     *   remitAddress1?: ?string,
     *   remitAddress2?: ?string,
     *   remitCity?: ?string,
     *   remitState?: ?string,
     *   remitZip?: ?string,
     *   remitCountry?: ?string,
     *   payeeName1?: ?string,
     *   payeeName2?: ?string,
     *   customField1?: ?string,
     *   customField2?: ?string,
     *   customerVendorAccount?: ?string,
     *   internalReferenceId?: ?int,
     *   paymentPortalUrl?: ?string,
     *   cardAccepted?: ?string,
     *   achAccepted?: ?string,
     *   checkAccepted?: ?string,
     *   enrichmentStatus?: ?string,
     *   enrichedBy?: ?string,
     *   enrichedAt?: ?DateTime,
     *   enrichmentId?: ?string,
     *   additionalData?: ?array<string, array<string, mixed>>,
     *   externalPaypointId?: ?string,
     *   storedMethods?: ?array<VendorResponseStoredMethod>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->vendorNumber = $values['vendorNumber'] ?? null;
        $this->name1 = $values['name1'] ?? null;
        $this->name2 = $values['name2'] ?? null;
        $this->ein = $values['ein'] ?? null;
        $this->phone = $values['phone'] ?? null;
        $this->email = $values['email'] ?? null;
        $this->remitEmail = $values['remitEmail'] ?? null;
        $this->address1 = $values['address1'] ?? null;
        $this->address2 = $values['address2'] ?? null;
        $this->city = $values['city'] ?? null;
        $this->state = $values['state'] ?? null;
        $this->zip = $values['zip'] ?? null;
        $this->country = $values['country'] ?? null;
        $this->mcc = $values['mcc'] ?? null;
        $this->locationCode = $values['locationCode'] ?? null;
        $this->contacts = $values['contacts'] ?? null;
        $this->billingData = $values['billingData'] ?? null;
        $this->paymentMethod = $values['paymentMethod'] ?? null;
        $this->vendorStatus = $values['vendorStatus'] ?? null;
        $this->vendorId = $values['vendorId'] ?? null;
        $this->enrollmentStatus = $values['enrollmentStatus'] ?? null;
        $this->summary = $values['summary'] ?? null;
        $this->paypointLegalname = $values['paypointLegalname'] ?? null;
        $this->paypointId = $values['paypointId'] ?? null;
        $this->paypointDbaname = $values['paypointDbaname'] ?? null;
        $this->paypointEntryname = $values['paypointEntryname'] ?? null;
        $this->parentOrgName = $values['parentOrgName'] ?? null;
        $this->parentOrgId = $values['parentOrgId'] ?? null;
        $this->createdDate = $values['createdDate'] ?? null;
        $this->lastUpdated = $values['lastUpdated'] ?? null;
        $this->remitAddress1 = $values['remitAddress1'] ?? null;
        $this->remitAddress2 = $values['remitAddress2'] ?? null;
        $this->remitCity = $values['remitCity'] ?? null;
        $this->remitState = $values['remitState'] ?? null;
        $this->remitZip = $values['remitZip'] ?? null;
        $this->remitCountry = $values['remitCountry'] ?? null;
        $this->payeeName1 = $values['payeeName1'] ?? null;
        $this->payeeName2 = $values['payeeName2'] ?? null;
        $this->customField1 = $values['customField1'] ?? null;
        $this->customField2 = $values['customField2'] ?? null;
        $this->customerVendorAccount = $values['customerVendorAccount'] ?? null;
        $this->internalReferenceId = $values['internalReferenceId'] ?? null;
        $this->paymentPortalUrl = $values['paymentPortalUrl'] ?? null;
        $this->cardAccepted = $values['cardAccepted'] ?? null;
        $this->achAccepted = $values['achAccepted'] ?? null;
        $this->checkAccepted = $values['checkAccepted'] ?? null;
        $this->enrichmentStatus = $values['enrichmentStatus'] ?? null;
        $this->enrichedBy = $values['enrichedBy'] ?? null;
        $this->enrichedAt = $values['enrichedAt'] ?? null;
        $this->enrichmentId = $values['enrichmentId'] ?? null;
        $this->additionalData = $values['additionalData'] ?? null;
        $this->externalPaypointId = $values['externalPaypointId'] ?? null;
        $this->storedMethods = $values['storedMethods'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
