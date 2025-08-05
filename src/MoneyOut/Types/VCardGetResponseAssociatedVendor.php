<?php

namespace Payabli\MoneyOut\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Types\Contacts;
use DateTime;
use Payabli\Core\Types\Date;
use Payabli\Types\VendorPaymentMethod;

/**
 * Information about the associated vendor.
 */
class VCardGetResponseAssociatedVendor extends JsonSerializableType
{
    /**
     * @var ?string $additionalData Field for additional data, if any.
     */
    #[JsonProperty('additionalData')]
    public ?string $additionalData;

    /**
     * @var ?string $address1 Primary address line of the vendor.
     */
    #[JsonProperty('Address1')]
    public ?string $address1;

    /**
     * @var ?string $address2 Secondary address line of the vendor.
     */
    #[JsonProperty('Address2')]
    public ?string $address2;

    /**
     * @var ?VCardGetResponseAssociatedVendorBillingData $billingData Billing data for the vendor.
     */
    #[JsonProperty('BillingData')]
    public ?VCardGetResponseAssociatedVendorBillingData $billingData;

    /**
     * @var ?string $city City where the vendor is located.
     */
    #[JsonProperty('City')]
    public ?string $city;

    /**
     * @var ?Contacts $contacts
     */
    #[JsonProperty('Contacts')]
    public ?Contacts $contacts;

    /**
     * @var ?string $country Country where the vendor is located.
     */
    #[JsonProperty('Country')]
    public ?string $country;

    /**
     * @var ?DateTime $createdDate Date when the vendor record was created.
     */
    #[JsonProperty('CreatedDate'), Date(Date::TYPE_DATETIME)]
    public ?DateTime $createdDate;

    /**
     * @var ?string $customerVendorAccount Account number of paypoint in the vendor side.
     */
    #[JsonProperty('customerVendorAccount')]
    public ?string $customerVendorAccount;

    /**
     * @var ?string $customField1 A custom field for additional data.
     */
    #[JsonProperty('customField1')]
    public ?string $customField1;

    /**
     * @var ?string $customField2 Another custom field for extra data.
     */
    #[JsonProperty('customField2')]
    public ?string $customField2;

    /**
     * @var ?string $ein Employer Identification Number of the vendor.
     */
    #[JsonProperty('EIN')]
    public ?string $ein;

    /**
     * @var ?string $email Contact email address of the vendor.
     */
    #[JsonProperty('Email')]
    public ?string $email;

    /**
     * @var ?string $enrollmentStatus Enrollment status of the vendor.
     */
    #[JsonProperty('EnrollmentStatus')]
    public ?string $enrollmentStatus;

    /**
     * @var ?string $externalPaypointId
     */
    #[JsonProperty('externalPaypointID')]
    public ?string $externalPaypointId;

    /**
     * @var ?int $internalReferenceId Internal reference ID used within the system.
     */
    #[JsonProperty('InternalReferenceId')]
    public ?int $internalReferenceId;

    /**
     * @var ?DateTime $lastUpdated Date when the vendor's information was last updated.
     */
    #[JsonProperty('LastUpdated'), Date(Date::TYPE_DATETIME)]
    public ?DateTime $lastUpdated;

    /**
     * @var ?string $locationCode Unique location code for the vendor.
     */
    #[JsonProperty('LocationCode')]
    public ?string $locationCode;

    /**
     * @var ?string $mcc Merchant Category Code for the vendor.
     */
    #[JsonProperty('Mcc')]
    public ?string $mcc;

    /**
     * @var ?string $name1 The primary name associated with the vendor.
     */
    #[JsonProperty('Name1')]
    public ?string $name1;

    /**
     * @var ?string $name2 Additional name information for the vendor.
     */
    #[JsonProperty('Name2')]
    public ?string $name2;

    /**
     * @var ?string $parentOrgName
     */
    #[JsonProperty('ParentOrgName')]
    public ?string $parentOrgName;

    /**
     * @var ?string $payeeName1 Primary name of the payee.
     */
    #[JsonProperty('payeeName1')]
    public ?string $payeeName1;

    /**
     * @var ?string $payeeName2 Secondary name of the payee.
     */
    #[JsonProperty('payeeName2')]
    public ?string $payeeName2;

    /**
     * @var ?VendorPaymentMethod $paymentMethod
     */
    #[JsonProperty('paymentMethod')]
    public ?VendorPaymentMethod $paymentMethod;

    /**
     * @var ?string $paypointDbaname DBA name of the paypoint.
     */
    #[JsonProperty('PaypointDbaname')]
    public ?string $paypointDbaname;

    /**
     * @var ?string $paypointEntryname Entryname of the paypoint.
     */
    #[JsonProperty('PaypointEntryname')]
    public ?string $paypointEntryname;

    /**
     * @var ?string $paypointLegalname Legal name of the paypoint.
     */
    #[JsonProperty('PaypointLegalname')]
    public ?string $paypointLegalname;

    /**
     * @var ?string $phone Contact phone number of the vendor.
     */
    #[JsonProperty('Phone')]
    public ?string $phone;

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
     * @var ?string $remitCountry
     */
    #[JsonProperty('remitCountry')]
    public ?string $remitCountry;

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
     * @var ?string $state State where the vendor is located.
     */
    #[JsonProperty('State')]
    public ?string $state;

    /**
     * @var ?VCardGetResponseAssociatedVendorSummary $summary Summary of vendor's billing and transaction status.
     */
    #[JsonProperty('Summary')]
    public ?VCardGetResponseAssociatedVendorSummary $summary;

    /**
     * @var ?int $vendorId Unique identifier for the vendor.
     */
    #[JsonProperty('VendorId')]
    public ?int $vendorId;

    /**
     * @var ?string $vendorNumber Unique code identifying the vendor.
     */
    #[JsonProperty('VendorNumber')]
    public ?string $vendorNumber;

    /**
     * @var ?int $vendorStatus Status of the vendor.
     */
    #[JsonProperty('VendorStatus')]
    public ?int $vendorStatus;

    /**
     * @var ?string $zip ZIP code for the vendor's location.
     */
    #[JsonProperty('Zip')]
    public ?string $zip;

    /**
     * @param array{
     *   additionalData?: ?string,
     *   address1?: ?string,
     *   address2?: ?string,
     *   billingData?: ?VCardGetResponseAssociatedVendorBillingData,
     *   city?: ?string,
     *   contacts?: ?Contacts,
     *   country?: ?string,
     *   createdDate?: ?DateTime,
     *   customerVendorAccount?: ?string,
     *   customField1?: ?string,
     *   customField2?: ?string,
     *   ein?: ?string,
     *   email?: ?string,
     *   enrollmentStatus?: ?string,
     *   externalPaypointId?: ?string,
     *   internalReferenceId?: ?int,
     *   lastUpdated?: ?DateTime,
     *   locationCode?: ?string,
     *   mcc?: ?string,
     *   name1?: ?string,
     *   name2?: ?string,
     *   parentOrgName?: ?string,
     *   payeeName1?: ?string,
     *   payeeName2?: ?string,
     *   paymentMethod?: ?VendorPaymentMethod,
     *   paypointDbaname?: ?string,
     *   paypointEntryname?: ?string,
     *   paypointLegalname?: ?string,
     *   phone?: ?string,
     *   remitAddress1?: ?string,
     *   remitAddress2?: ?string,
     *   remitCity?: ?string,
     *   remitCountry?: ?string,
     *   remitState?: ?string,
     *   remitZip?: ?string,
     *   state?: ?string,
     *   summary?: ?VCardGetResponseAssociatedVendorSummary,
     *   vendorId?: ?int,
     *   vendorNumber?: ?string,
     *   vendorStatus?: ?int,
     *   zip?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->additionalData = $values['additionalData'] ?? null;
        $this->address1 = $values['address1'] ?? null;
        $this->address2 = $values['address2'] ?? null;
        $this->billingData = $values['billingData'] ?? null;
        $this->city = $values['city'] ?? null;
        $this->contacts = $values['contacts'] ?? null;
        $this->country = $values['country'] ?? null;
        $this->createdDate = $values['createdDate'] ?? null;
        $this->customerVendorAccount = $values['customerVendorAccount'] ?? null;
        $this->customField1 = $values['customField1'] ?? null;
        $this->customField2 = $values['customField2'] ?? null;
        $this->ein = $values['ein'] ?? null;
        $this->email = $values['email'] ?? null;
        $this->enrollmentStatus = $values['enrollmentStatus'] ?? null;
        $this->externalPaypointId = $values['externalPaypointId'] ?? null;
        $this->internalReferenceId = $values['internalReferenceId'] ?? null;
        $this->lastUpdated = $values['lastUpdated'] ?? null;
        $this->locationCode = $values['locationCode'] ?? null;
        $this->mcc = $values['mcc'] ?? null;
        $this->name1 = $values['name1'] ?? null;
        $this->name2 = $values['name2'] ?? null;
        $this->parentOrgName = $values['parentOrgName'] ?? null;
        $this->payeeName1 = $values['payeeName1'] ?? null;
        $this->payeeName2 = $values['payeeName2'] ?? null;
        $this->paymentMethod = $values['paymentMethod'] ?? null;
        $this->paypointDbaname = $values['paypointDbaname'] ?? null;
        $this->paypointEntryname = $values['paypointEntryname'] ?? null;
        $this->paypointLegalname = $values['paypointLegalname'] ?? null;
        $this->phone = $values['phone'] ?? null;
        $this->remitAddress1 = $values['remitAddress1'] ?? null;
        $this->remitAddress2 = $values['remitAddress2'] ?? null;
        $this->remitCity = $values['remitCity'] ?? null;
        $this->remitCountry = $values['remitCountry'] ?? null;
        $this->remitState = $values['remitState'] ?? null;
        $this->remitZip = $values['remitZip'] ?? null;
        $this->state = $values['state'] ?? null;
        $this->summary = $values['summary'] ?? null;
        $this->vendorId = $values['vendorId'] ?? null;
        $this->vendorNumber = $values['vendorNumber'] ?? null;
        $this->vendorStatus = $values['vendorStatus'] ?? null;
        $this->zip = $values['zip'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
