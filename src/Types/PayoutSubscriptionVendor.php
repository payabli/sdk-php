<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Core\Types\ArrayType;
use DateTime;
use Payabli\Core\Types\Date;

/**
 * The vendor associated with the payout subscription.
 */
class PayoutSubscriptionVendor extends JsonSerializableType
{
    /**
     * @var string $vendorNumber
     */
    #[JsonProperty('vendorNumber')]
    public string $vendorNumber;

    /**
     * @var string $name1
     */
    #[JsonProperty('name1')]
    public string $name1;

    /**
     * @var ?string $name2
     */
    #[JsonProperty('name2')]
    public ?string $name2;

    /**
     * @var ?string $ein
     */
    #[JsonProperty('ein')]
    public ?string $ein;

    /**
     * @var ?string $phone
     */
    #[JsonProperty('phone')]
    public ?string $phone;

    /**
     * @var ?string $email
     */
    #[JsonProperty('email')]
    public ?string $email;

    /**
     * @var ?string $remitEmail
     */
    #[JsonProperty('remitEmail')]
    public ?string $remitEmail;

    /**
     * @var ?string $address1 The address.
     */
    #[JsonProperty('address1')]
    public ?string $address1;

    /**
     * @var ?string $address2 Additional line for the address.
     */
    #[JsonProperty('address2')]
    public ?string $address2;

    /**
     * @var ?string $city The city.
     */
    #[JsonProperty('city')]
    public ?string $city;

    /**
     * @var ?string $state The state or province.
     */
    #[JsonProperty('state')]
    public ?string $state;

    /**
     * @var ?string $zip
     */
    #[JsonProperty('zip')]
    public ?string $zip;

    /**
     * @var ?string $country
     */
    #[JsonProperty('country')]
    public ?string $country;

    /**
     * @var ?string $mcc
     */
    #[JsonProperty('mcc')]
    public ?string $mcc;

    /**
     * @var ?string $locationCode
     */
    #[JsonProperty('locationCode')]
    public ?string $locationCode;

    /**
     * @var bool $issue1099
     */
    #[JsonProperty('issue1099')]
    public bool $issue1099;

    /**
     * @var ?array<PayoutSubscriptionVendorContact> $contacts Array of objects describing the vendor's contacts.
     */
    #[JsonProperty('contacts'), ArrayType([PayoutSubscriptionVendorContact::class])]
    public ?array $contacts;

    /**
     * @var ?BillingDataResponse $billingData
     */
    #[JsonProperty('billingData')]
    public ?BillingDataResponse $billingData;

    /**
     * @var ?string $paymentMethod
     */
    #[JsonProperty('paymentMethod')]
    public ?string $paymentMethod;

    /**
     * @var int $vendorStatus
     */
    #[JsonProperty('vendorStatus')]
    public int $vendorStatus;

    /**
     * @var int $vendorId
     */
    #[JsonProperty('vendorId')]
    public int $vendorId;

    /**
     * @var ?string $enrollmentStatus
     */
    #[JsonProperty('enrollmentStatus')]
    public ?string $enrollmentStatus;

    /**
     * @var ?VendorSummary $summary Summary of the vendor's bills. Always `null` on this endpoint.
     */
    #[JsonProperty('summary')]
    public ?VendorSummary $summary;

    /**
     * @var string $paypointLegalname
     */
    #[JsonProperty('paypointLegalname')]
    public string $paypointLegalname;

    /**
     * @var ?int $paypointId The paypoint's ID. This is different from the entryname.
     */
    #[JsonProperty('paypointId')]
    public ?int $paypointId;

    /**
     * @var string $paypointDbaname
     */
    #[JsonProperty('paypointDbaname')]
    public string $paypointDbaname;

    /**
     * @var string $paypointEntryname
     */
    #[JsonProperty('paypointEntryname')]
    public string $paypointEntryname;

    /**
     * @var string $parentOrgName
     */
    #[JsonProperty('parentOrgName')]
    public string $parentOrgName;

    /**
     * @var int $parentOrgId
     */
    #[JsonProperty('parentOrgId')]
    public int $parentOrgId;

    /**
     * @var DateTime $createdDate
     */
    #[JsonProperty('createdDate'), Date(Date::TYPE_DATETIME)]
    public DateTime $createdDate;

    /**
     * @var DateTime $lastUpdated
     */
    #[JsonProperty('lastUpdated'), Date(Date::TYPE_DATETIME)]
    public DateTime $lastUpdated;

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
     * @var int $internalReferenceId
     */
    #[JsonProperty('internalReferenceId')]
    public int $internalReferenceId;

    /**
     * @var ?string $paymentPortalUrl URL for the vendor's online payment portal, if known. Populated by the vendor enrichment pipeline.
     */
    #[JsonProperty('paymentPortalUrl')]
    public ?string $paymentPortalUrl;

    /**
     * @var ?string $cardAccepted Whether the vendor accepts card payments. Values are `yes`, `no`, or `unable to determine`. Populated by the vendor enrichment pipeline.
     */
    #[JsonProperty('cardAccepted')]
    public ?string $cardAccepted;

    /**
     * @var ?string $achAccepted Whether the vendor accepts ACH payments. Values are `yes`, `no`, or `unable to determine`. Populated by the vendor enrichment pipeline.
     */
    #[JsonProperty('achAccepted')]
    public ?string $achAccepted;

    /**
     * @var ?string $checkAccepted Whether the vendor accepts check payments. Values are `yes`, `no`, or `unable to determine`. Populated by the vendor enrichment pipeline.
     */
    #[JsonProperty('checkAccepted')]
    public ?string $checkAccepted;

    /**
     * @var string $enrichmentStatus Current enrichment state of the vendor. Values are `not_enriched`, `partially_enriched`, `fully_enriched`, or `fallback_applied`.
     */
    #[JsonProperty('enrichmentStatus')]
    public string $enrichmentStatus;

    /**
     * @var ?string $enrichedBy Which enrichment method resolved the vendor's payment acceptance info. Values are `invoice_scan`, `web_search`, `vendor_network`, or `manual`.
     */
    #[JsonProperty('enrichedBy')]
    public ?string $enrichedBy;

    /**
     * @var ?DateTime $enrichedAt When the vendor was last enriched (UTC).
     */
    #[JsonProperty('enrichedAt'), Date(Date::TYPE_DATETIME)]
    public ?DateTime $enrichedAt;

    /**
     * @var ?string $enrichmentId Identifier for the enrichment request that last updated this vendor.
     */
    #[JsonProperty('enrichmentId')]
    public ?string $enrichmentId;

    /**
     * @var ?array<string, string> $additionalData
     */
    #[JsonProperty('additionalData'), ArrayType(['string' => 'string'])]
    public ?array $additionalData;

    /**
     * @var ?string $externalPaypointId
     */
    #[JsonProperty('externalPaypointID')]
    public ?string $externalPaypointId;

    /**
     * @var ?array<VendorResponseStoredMethod> $storedMethods The vendor's stored payment methods. Always `null` on this endpoint.
     */
    #[JsonProperty('storedMethods'), ArrayType([VendorResponseStoredMethod::class])]
    public ?array $storedMethods;

    /**
     * @var ?PayoutSubscriptionVendorVendorPortal $vendorPortal The vendor's vendor portal access. Always `null` on this endpoint.
     */
    #[JsonProperty('vendorPortal')]
    public ?PayoutSubscriptionVendorVendorPortal $vendorPortal;

    /**
     * @param array{
     *   vendorNumber: string,
     *   name1: string,
     *   issue1099: bool,
     *   vendorStatus: int,
     *   vendorId: int,
     *   paypointLegalname: string,
     *   paypointDbaname: string,
     *   paypointEntryname: string,
     *   parentOrgName: string,
     *   parentOrgId: int,
     *   createdDate: DateTime,
     *   lastUpdated: DateTime,
     *   internalReferenceId: int,
     *   enrichmentStatus: string,
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
     *   contacts?: ?array<PayoutSubscriptionVendorContact>,
     *   billingData?: ?BillingDataResponse,
     *   paymentMethod?: ?string,
     *   enrollmentStatus?: ?string,
     *   summary?: ?VendorSummary,
     *   paypointId?: ?int,
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
     *   paymentPortalUrl?: ?string,
     *   cardAccepted?: ?string,
     *   achAccepted?: ?string,
     *   checkAccepted?: ?string,
     *   enrichedBy?: ?string,
     *   enrichedAt?: ?DateTime,
     *   enrichmentId?: ?string,
     *   additionalData?: ?array<string, string>,
     *   externalPaypointId?: ?string,
     *   storedMethods?: ?array<VendorResponseStoredMethod>,
     *   vendorPortal?: ?PayoutSubscriptionVendorVendorPortal,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->vendorNumber = $values['vendorNumber'];
        $this->name1 = $values['name1'];
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
        $this->issue1099 = $values['issue1099'];
        $this->contacts = $values['contacts'] ?? null;
        $this->billingData = $values['billingData'] ?? null;
        $this->paymentMethod = $values['paymentMethod'] ?? null;
        $this->vendorStatus = $values['vendorStatus'];
        $this->vendorId = $values['vendorId'];
        $this->enrollmentStatus = $values['enrollmentStatus'] ?? null;
        $this->summary = $values['summary'] ?? null;
        $this->paypointLegalname = $values['paypointLegalname'];
        $this->paypointId = $values['paypointId'] ?? null;
        $this->paypointDbaname = $values['paypointDbaname'];
        $this->paypointEntryname = $values['paypointEntryname'];
        $this->parentOrgName = $values['parentOrgName'];
        $this->parentOrgId = $values['parentOrgId'];
        $this->createdDate = $values['createdDate'];
        $this->lastUpdated = $values['lastUpdated'];
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
        $this->internalReferenceId = $values['internalReferenceId'];
        $this->paymentPortalUrl = $values['paymentPortalUrl'] ?? null;
        $this->cardAccepted = $values['cardAccepted'] ?? null;
        $this->achAccepted = $values['achAccepted'] ?? null;
        $this->checkAccepted = $values['checkAccepted'] ?? null;
        $this->enrichmentStatus = $values['enrichmentStatus'];
        $this->enrichedBy = $values['enrichedBy'] ?? null;
        $this->enrichedAt = $values['enrichedAt'] ?? null;
        $this->enrichmentId = $values['enrichmentId'] ?? null;
        $this->additionalData = $values['additionalData'] ?? null;
        $this->externalPaypointId = $values['externalPaypointId'] ?? null;
        $this->storedMethods = $values['storedMethods'] ?? null;
        $this->vendorPortal = $values['vendorPortal'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
