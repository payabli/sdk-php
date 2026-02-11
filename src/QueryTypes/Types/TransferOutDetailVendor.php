<?php

namespace Payabli\QueryTypes\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Types\ContactsResponse;
use Payabli\Core\Types\ArrayType;

/**
 * Vendor information for an outbound transfer detail.
 */
class TransferOutDetailVendor extends JsonSerializableType
{
    /**
     * @var ?string $vendorNumber The vendor's unique number.
     */
    #[JsonProperty('VendorNumber')]
    public ?string $vendorNumber;

    /**
     * @var ?string $name1 Primary name of the vendor.
     */
    #[JsonProperty('Name1')]
    public ?string $name1;

    /**
     * @var ?string $name2 Secondary name of the vendor.
     */
    #[JsonProperty('Name2')]
    public ?string $name2;

    /**
     * @var ?string $ein Employer Identification Number.
     */
    #[JsonProperty('EIN')]
    public ?string $ein;

    /**
     * @var ?string $phone Vendor's phone number.
     */
    #[JsonProperty('Phone')]
    public ?string $phone;

    /**
     * @var ?string $email Vendor's email address.
     */
    #[JsonProperty('Email')]
    public ?string $email;

    /**
     * @var ?string $remitEmail Email for remittance notifications.
     */
    #[JsonProperty('RemitEmail')]
    public ?string $remitEmail;

    /**
     * @var ?string $address1 Primary address line.
     */
    #[JsonProperty('Address1')]
    public ?string $address1;

    /**
     * @var ?string $address2 Secondary address line.
     */
    #[JsonProperty('Address2')]
    public ?string $address2;

    /**
     * @var ?string $city City of the vendor.
     */
    #[JsonProperty('City')]
    public ?string $city;

    /**
     * @var ?string $state State of the vendor.
     */
    #[JsonProperty('State')]
    public ?string $state;

    /**
     * @var ?string $zip ZIP code of the vendor.
     */
    #[JsonProperty('Zip')]
    public ?string $zip;

    /**
     * @var ?string $country Country of the vendor.
     */
    #[JsonProperty('Country')]
    public ?string $country;

    /**
     * @var ?string $mcc Merchant Category Code.
     */
    #[JsonProperty('Mcc')]
    public ?string $mcc;

    /**
     * @var ?string $locationCode Location code for the vendor.
     */
    #[JsonProperty('LocationCode')]
    public ?string $locationCode;

    /**
     * @var ?array<ContactsResponse> $contacts List of contacts for the vendor.
     */
    #[JsonProperty('Contacts'), ArrayType([ContactsResponse::class])]
    public ?array $contacts;

    /**
     * @var ?TransferOutDetailVendorBillingData $billingData Billing data for the vendor.
     */
    #[JsonProperty('BillingData')]
    public ?TransferOutDetailVendorBillingData $billingData;

    /**
     * @var ?string $paymentMethod Preferred payment method.
     */
    #[JsonProperty('PaymentMethod')]
    public ?string $paymentMethod;

    /**
     * @var ?int $vendorStatus Status of the vendor.
     */
    #[JsonProperty('VendorStatus')]
    public ?int $vendorStatus;

    /**
     * @var ?int $vendorId Unique identifier for the vendor.
     */
    #[JsonProperty('VendorId')]
    public ?int $vendorId;

    /**
     * @var ?int $enrollmentStatus Enrollment status of the vendor.
     */
    #[JsonProperty('EnrollmentStatus')]
    public ?int $enrollmentStatus;

    /**
     * @var ?string $summary Summary information about the vendor.
     */
    #[JsonProperty('Summary')]
    public ?string $summary;

    /**
     * @var ?string $paypointLegalname Legal name of the paypoint.
     */
    #[JsonProperty('PaypointLegalname')]
    public ?string $paypointLegalname;

    /**
     * @var ?int $paypointId ID of the paypoint.
     */
    #[JsonProperty('PaypointId')]
    public ?int $paypointId;

    /**
     * @var ?string $paypointDbaname DBA name of the paypoint.
     */
    #[JsonProperty('PaypointDbaname')]
    public ?string $paypointDbaname;

    /**
     * @var ?string $paypointEntryname Entry name of the paypoint.
     */
    #[JsonProperty('PaypointEntryname')]
    public ?string $paypointEntryname;

    /**
     * @var ?string $parentOrgName Name of the parent organization.
     */
    #[JsonProperty('ParentOrgName')]
    public ?string $parentOrgName;

    /**
     * @var ?int $parentOrgId ID of the parent organization.
     */
    #[JsonProperty('ParentOrgId')]
    public ?int $parentOrgId;

    /**
     * @var ?string $createdDate Date the vendor was created.
     */
    #[JsonProperty('CreatedDate')]
    public ?string $createdDate;

    /**
     * @var ?string $lastUpdated Date the vendor was last updated.
     */
    #[JsonProperty('LastUpdated')]
    public ?string $lastUpdated;

    /**
     * @var ?string $remitAddress1 Primary remittance address line.
     */
    #[JsonProperty('remitAddress1')]
    public ?string $remitAddress1;

    /**
     * @var ?string $remitAddress2 Secondary remittance address line.
     */
    #[JsonProperty('remitAddress2')]
    public ?string $remitAddress2;

    /**
     * @var ?string $remitCity Remittance city.
     */
    #[JsonProperty('remitCity')]
    public ?string $remitCity;

    /**
     * @var ?string $remitState Remittance state.
     */
    #[JsonProperty('remitState')]
    public ?string $remitState;

    /**
     * @var ?string $remitZip Remittance ZIP code.
     */
    #[JsonProperty('remitZip')]
    public ?string $remitZip;

    /**
     * @var ?string $remitCountry Remittance country.
     */
    #[JsonProperty('remitCountry')]
    public ?string $remitCountry;

    /**
     * @var ?string $payeeName1 Primary payee name.
     */
    #[JsonProperty('payeeName1')]
    public ?string $payeeName1;

    /**
     * @var ?string $payeeName2 Secondary payee name.
     */
    #[JsonProperty('payeeName2')]
    public ?string $payeeName2;

    /**
     * @var ?string $customField1 Custom field 1.
     */
    #[JsonProperty('customField1')]
    public ?string $customField1;

    /**
     * @var ?string $customField2 Custom field 2.
     */
    #[JsonProperty('customField2')]
    public ?string $customField2;

    /**
     * @var ?string $customerVendorAccount Customer vendor account number.
     */
    #[JsonProperty('customerVendorAccount')]
    public ?string $customerVendorAccount;

    /**
     * @var ?int $internalReferenceId Internal reference ID.
     */
    #[JsonProperty('InternalReferenceId')]
    public ?int $internalReferenceId;

    /**
     * @var ?array<string, mixed> $additionalData Additional data for the vendor.
     */
    #[JsonProperty('additionalData'), ArrayType(['string' => 'mixed'])]
    public ?array $additionalData;

    /**
     * @var ?string $externalPaypointId External paypoint ID.
     */
    #[JsonProperty('externalPaypointID')]
    public ?string $externalPaypointId;

    /**
     * @var ?array<mixed> $storedMethods Stored payment methods for the vendor.
     */
    #[JsonProperty('StoredMethods'), ArrayType(['mixed'])]
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
     *   billingData?: ?TransferOutDetailVendorBillingData,
     *   paymentMethod?: ?string,
     *   vendorStatus?: ?int,
     *   vendorId?: ?int,
     *   enrollmentStatus?: ?int,
     *   summary?: ?string,
     *   paypointLegalname?: ?string,
     *   paypointId?: ?int,
     *   paypointDbaname?: ?string,
     *   paypointEntryname?: ?string,
     *   parentOrgName?: ?string,
     *   parentOrgId?: ?int,
     *   createdDate?: ?string,
     *   lastUpdated?: ?string,
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
     *   additionalData?: ?array<string, mixed>,
     *   externalPaypointId?: ?string,
     *   storedMethods?: ?array<mixed>,
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
