<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Core\Types\ArrayType;
use Payabli\Core\Types\Union;
use DateTime;
use Payabli\Core\Types\Date;

class VendorQueryRecord extends JsonSerializableType
{
    /**
     * @var ?array<string, ?array<string, mixed>> $additionalData
     */
    #[JsonProperty('additionalData'), ArrayType(['string' => new Union(['string' => 'mixed'], 'null')])]
    public ?array $additionalData;

    /**
     * @var ?string $address1 Vendor's address.
     */
    #[JsonProperty('address1')]
    public ?string $address1;

    /**
     * @var ?string $address2 Additional line for vendor's address.
     */
    #[JsonProperty('address2')]
    public ?string $address2;

    /**
     * @var ?BillingDataResponse $billingData
     */
    #[JsonProperty('billingData')]
    public ?BillingDataResponse $billingData;

    /**
     * @var ?string $city Vendor's city.
     */
    #[JsonProperty('city')]
    public ?string $city;

    /**
     * @var ?array<Contacts> $contacts
     */
    #[JsonProperty('contacts'), ArrayType([Contacts::class])]
    public ?array $contacts;

    /**
     * @var ?string $country Vendor's country.
     */
    #[JsonProperty('country')]
    public ?string $country;

    /**
     * @var ?DateTime $createdDate
     */
    #[JsonProperty('createdDate'), Date(Date::TYPE_DATETIME)]
    public ?DateTime $createdDate;

    /**
     * @var ?string $customerVendorAccount Account number of paypoint in the vendor system.
     */
    #[JsonProperty('customerVendorAccount')]
    public ?string $customerVendorAccount;

    /**
     * @var ?string $ein
     */
    #[JsonProperty('ein')]
    public ?string $ein;

    /**
     * @var ?string $email Vendor's email address.
     */
    #[JsonProperty('email')]
    public ?string $email;

    /**
     * @var ?string $enrollmentStatus
     */
    #[JsonProperty('enrollmentStatus')]
    public ?string $enrollmentStatus;

    /**
     * @var ?string $externalPaypointId
     */
    #[JsonProperty('externalPaypointId')]
    public ?string $externalPaypointId;

    /**
     * @var ?int $internalReferenceId
     */
    #[JsonProperty('internalReferenceId')]
    public ?int $internalReferenceId;

    /**
     * @var ?DateTime $lastUpdated
     */
    #[JsonProperty('lastUpdated'), Date(Date::TYPE_DATETIME)]
    public ?DateTime $lastUpdated;

    /**
     * @var ?string $locationCode Additional location code used to identify the vendor.
     */
    #[JsonProperty('locationCode')]
    public ?string $locationCode;

    /**
     * @var ?string $mcc
     */
    #[JsonProperty('mcc')]
    public ?string $mcc;

    /**
     * @var ?string $name1 Primary name for vendor.
     */
    #[JsonProperty('name1')]
    public ?string $name1;

    /**
     * @var ?string $name2 Secondary name for vendor.
     */
    #[JsonProperty('name2')]
    public ?string $name2;

    /**
     * @var ?string $parentOrgName
     */
    #[JsonProperty('parentOrgName')]
    public ?string $parentOrgName;

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
     * @var ?VendorPaymentMethod $paymentMethod
     */
    #[JsonProperty('paymentMethod')]
    public ?VendorPaymentMethod $paymentMethod;

    /**
     * @var ?string $paypointDbaname
     */
    #[JsonProperty('paypointDbaname')]
    public ?string $paypointDbaname;

    /**
     * @var ?string $paypointEntryname
     */
    #[JsonProperty('paypointEntryname')]
    public ?string $paypointEntryname;

    /**
     * @var ?string $paypointLegalname
     */
    #[JsonProperty('paypointLegalname')]
    public ?string $paypointLegalname;

    /**
     * @var ?string $phone Vendor's phone number.
     */
    #[JsonProperty('phone')]
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
     * @var ?string $state Vendor's state.
     */
    #[JsonProperty('state')]
    public ?string $state;

    /**
     * @var ?VendorSummary $summary
     */
    #[JsonProperty('summary')]
    public ?VendorSummary $summary;

    /**
     * @var ?int $vendorId
     */
    #[JsonProperty('vendorId')]
    public ?int $vendorId;

    /**
     * @var ?string $vendorNumber
     */
    #[JsonProperty('vendorNumber')]
    public ?string $vendorNumber;

    /**
     * @var ?int $vendorStatus
     */
    #[JsonProperty('vendorStatus')]
    public ?int $vendorStatus;

    /**
     * @var ?string $zip Vendor's zip code.
     */
    #[JsonProperty('zip')]
    public ?string $zip;

    /**
     * @param array{
     *   additionalData?: ?array<string, ?array<string, mixed>>,
     *   address1?: ?string,
     *   address2?: ?string,
     *   billingData?: ?BillingDataResponse,
     *   city?: ?string,
     *   contacts?: ?array<Contacts>,
     *   country?: ?string,
     *   createdDate?: ?DateTime,
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
     *   summary?: ?VendorSummary,
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
