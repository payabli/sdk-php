<?php

namespace Payabli\TokenStorage\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Core\Types\ArrayType;
use Payabli\Types\VendorResponseBillingData;
use Payabli\Types\Contacts;
use DateTime;
use Payabli\Core\Types\Date;
use Payabli\Types\VendorResponseStoredMethod;
use Payabli\Types\VendorResponseSummary;

class GetMethodResponseResponseDataVendorsItem extends JsonSerializableType
{
    /**
     * @var ?array<string, string> $additionalData Additional data for vendor
     */
    #[JsonProperty('additionalData'), ArrayType(['string' => 'string'])]
    public ?array $additionalData;

    /**
     * @var ?string $address1 Vendor's address
     */
    #[JsonProperty('address1')]
    public ?string $address1;

    /**
     * @var ?string $address2 Additional line for vendor's address
     */
    #[JsonProperty('address2')]
    public ?string $address2;

    /**
     * @var ?VendorResponseBillingData $billingData Object containing vendor's bank information
     */
    #[JsonProperty('billingData')]
    public ?VendorResponseBillingData $billingData;

    /**
     * @var ?string $city Vendor's city
     */
    #[JsonProperty('city')]
    public ?string $city;

    /**
     * @var ?array<Contacts> $contacts Array of objects describing the vendor's contacts
     */
    #[JsonProperty('contacts'), ArrayType([Contacts::class])]
    public ?array $contacts;

    /**
     * @var ?string $country Vendor's country
     */
    #[JsonProperty('country')]
    public ?string $country;

    /**
     * @var ?DateTime $createdDate Date when vendor was created
     */
    #[JsonProperty('createdDate'), Date(Date::TYPE_DATETIME)]
    public ?DateTime $createdDate;

    /**
     * @var ?string $customField1 Custom field 1 for vendor
     */
    #[JsonProperty('customField1')]
    public ?string $customField1;

    /**
     * @var ?string $customField2 Custom field 2 for vendor
     */
    #[JsonProperty('customField2')]
    public ?string $customField2;

    /**
     * @var ?string $customerVendorAccount Account number of paypoint in the vendor's side
     */
    #[JsonProperty('customerVendorAccount')]
    public ?string $customerVendorAccount;

    /**
     * @var ?string $ein EIN/Tax ID for vendor. In responses, this field is masked.
     */
    #[JsonProperty('ein')]
    public ?string $ein;

    /**
     * @var ?string $email Vendor's email address
     */
    #[JsonProperty('email')]
    public ?string $email;

    /**
     * @var ?string $enrollmentStatus Vendor enrollment status
     */
    #[JsonProperty('enrollmentStatus')]
    public ?string $enrollmentStatus;

    /**
     * @var ?string $externalPaypointId External paypoint identifier
     */
    #[JsonProperty('externalPaypointID')]
    public ?string $externalPaypointId;

    /**
     * @var ?int $internalReferenceId Internal reference ID for vendor
     */
    #[JsonProperty('internalReferenceId')]
    public ?int $internalReferenceId;

    /**
     * @var ?DateTime $lastUpdated Date when vendor was last updated
     */
    #[JsonProperty('lastUpdated'), Date(Date::TYPE_DATETIME)]
    public ?DateTime $lastUpdated;

    /**
     * @var ?string $locationCode Location code for vendor
     */
    #[JsonProperty('locationCode')]
    public ?string $locationCode;

    /**
     * @var ?string $mcc Merchant category code
     */
    #[JsonProperty('mcc')]
    public ?string $mcc;

    /**
     * @var ?string $name1 Primary name for vendor
     */
    #[JsonProperty('name1')]
    public ?string $name1;

    /**
     * @var ?string $name2 Secondary name for vendor
     */
    #[JsonProperty('name2')]
    public ?string $name2;

    /**
     * @var ?int $parentOrgId ID of the parent organization
     */
    #[JsonProperty('parentOrgId')]
    public ?int $parentOrgId;

    /**
     * @var ?string $parentOrgName Name of the parent organization
     */
    #[JsonProperty('parentOrgName')]
    public ?string $parentOrgName;

    /**
     * @var ?string $payeeName1 Primary payee name
     */
    #[JsonProperty('payeeName1')]
    public ?string $payeeName1;

    /**
     * @var ?string $payeeName2 Secondary payee name
     */
    #[JsonProperty('payeeName2')]
    public ?string $payeeName2;

    /**
     * @var ?string $paymentMethod Preferred payment method for vendor
     */
    #[JsonProperty('paymentMethod')]
    public ?string $paymentMethod;

    /**
     * @var ?string $paypointDbaname DBA name of the paypoint
     */
    #[JsonProperty('paypointDbaname')]
    public ?string $paypointDbaname;

    /**
     * @var ?string $paypointEntryname Entry name of the paypoint
     */
    #[JsonProperty('paypointEntryname')]
    public ?string $paypointEntryname;

    /**
     * @var ?string $paypointId Paypoint ID
     */
    #[JsonProperty('paypointId')]
    public ?string $paypointId;

    /**
     * @var ?string $paypointLegalname Legal name of the paypoint
     */
    #[JsonProperty('paypointLegalname')]
    public ?string $paypointLegalname;

    /**
     * @var ?string $phone Vendor's phone number
     */
    #[JsonProperty('phone')]
    public ?string $phone;

    /**
     * @var ?string $remitAddress1 Remittance address line 1
     */
    #[JsonProperty('remitAddress1')]
    public ?string $remitAddress1;

    /**
     * @var ?string $remitAddress2 Remittance address line 2
     */
    #[JsonProperty('remitAddress2')]
    public ?string $remitAddress2;

    /**
     * @var ?string $remitCity Remittance city
     */
    #[JsonProperty('remitCity')]
    public ?string $remitCity;

    /**
     * @var ?string $remitCountry Remittance country
     */
    #[JsonProperty('remitCountry')]
    public ?string $remitCountry;

    /**
     * @var ?string $remitEmail Email address for remittance
     */
    #[JsonProperty('remitEmail')]
    public ?string $remitEmail;

    /**
     * @var ?string $remitState Remittance state
     */
    #[JsonProperty('remitState')]
    public ?string $remitState;

    /**
     * @var ?string $remitZip Remittance ZIP code
     */
    #[JsonProperty('remitZip')]
    public ?string $remitZip;

    /**
     * @var ?string $state Vendor's state
     */
    #[JsonProperty('state')]
    public ?string $state;

    /**
     * @var ?array<VendorResponseStoredMethod> $storedMethods Array of stored payment methods for vendor
     */
    #[JsonProperty('storedMethods'), ArrayType([VendorResponseStoredMethod::class])]
    public ?array $storedMethods;

    /**
     * @var ?VendorResponseSummary $summary Vendor bill summary statistics
     */
    #[JsonProperty('summary')]
    public ?VendorResponseSummary $summary;

    /**
     * @var ?int $vendorId The unique numeric ID assigned to the vendor in Payabli
     */
    #[JsonProperty('vendorId')]
    public ?int $vendorId;

    /**
     * @var ?string $vendorNumber Custom vendor number assigned by the business
     */
    #[JsonProperty('vendorNumber')]
    public ?string $vendorNumber;

    /**
     * @var ?int $vendorStatus Status code for the vendor
     */
    #[JsonProperty('vendorStatus')]
    public ?int $vendorStatus;

    /**
     * @var ?string $zip Vendor's ZIP code
     */
    #[JsonProperty('zip')]
    public ?string $zip;

    /**
     * @param array{
     *   additionalData?: ?array<string, string>,
     *   address1?: ?string,
     *   address2?: ?string,
     *   billingData?: ?VendorResponseBillingData,
     *   city?: ?string,
     *   contacts?: ?array<Contacts>,
     *   country?: ?string,
     *   createdDate?: ?DateTime,
     *   customField1?: ?string,
     *   customField2?: ?string,
     *   customerVendorAccount?: ?string,
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
     *   parentOrgId?: ?int,
     *   parentOrgName?: ?string,
     *   payeeName1?: ?string,
     *   payeeName2?: ?string,
     *   paymentMethod?: ?string,
     *   paypointDbaname?: ?string,
     *   paypointEntryname?: ?string,
     *   paypointId?: ?string,
     *   paypointLegalname?: ?string,
     *   phone?: ?string,
     *   remitAddress1?: ?string,
     *   remitAddress2?: ?string,
     *   remitCity?: ?string,
     *   remitCountry?: ?string,
     *   remitEmail?: ?string,
     *   remitState?: ?string,
     *   remitZip?: ?string,
     *   state?: ?string,
     *   storedMethods?: ?array<VendorResponseStoredMethod>,
     *   summary?: ?VendorResponseSummary,
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
        $this->customField1 = $values['customField1'] ?? null;
        $this->customField2 = $values['customField2'] ?? null;
        $this->customerVendorAccount = $values['customerVendorAccount'] ?? null;
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
        $this->parentOrgId = $values['parentOrgId'] ?? null;
        $this->parentOrgName = $values['parentOrgName'] ?? null;
        $this->payeeName1 = $values['payeeName1'] ?? null;
        $this->payeeName2 = $values['payeeName2'] ?? null;
        $this->paymentMethod = $values['paymentMethod'] ?? null;
        $this->paypointDbaname = $values['paypointDbaname'] ?? null;
        $this->paypointEntryname = $values['paypointEntryname'] ?? null;
        $this->paypointId = $values['paypointId'] ?? null;
        $this->paypointLegalname = $values['paypointLegalname'] ?? null;
        $this->phone = $values['phone'] ?? null;
        $this->remitAddress1 = $values['remitAddress1'] ?? null;
        $this->remitAddress2 = $values['remitAddress2'] ?? null;
        $this->remitCity = $values['remitCity'] ?? null;
        $this->remitCountry = $values['remitCountry'] ?? null;
        $this->remitEmail = $values['remitEmail'] ?? null;
        $this->remitState = $values['remitState'] ?? null;
        $this->remitZip = $values['remitZip'] ?? null;
        $this->state = $values['state'] ?? null;
        $this->storedMethods = $values['storedMethods'] ?? null;
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
