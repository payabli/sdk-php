<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Core\Types\ArrayType;
use DateTime;
use Payabli\Core\Types\Date;

/**
 * The customer record that owns the stored payment method.
 */
class GetMethodResponseResponseDataCustomersItem extends JsonSerializableType
{
    /**
     * @var ?array<string, string> $additionalFields List of additional custom fields in format key:value.
     */
    #[JsonProperty('additionalFields'), ArrayType(['string' => 'string'])]
    public ?array $additionalFields;

    /**
     * @var ?string $address Customer address.
     */
    #[JsonProperty('address')]
    public ?string $address;

    /**
     * @var ?string $address1 Additional line for customer address.
     */
    #[JsonProperty('address1')]
    public ?string $address1;

    /**
     * @var ?float $balance Customer's current balance
     */
    #[JsonProperty('balance')]
    public ?float $balance;

    /**
     * @var ?string $city Customer city.
     */
    #[JsonProperty('city')]
    public ?string $city;

    /**
     * @var ?string $company Company name.
     */
    #[JsonProperty('company')]
    public ?string $company;

    /**
     * @var ?string $country Customer country.
     */
    #[JsonProperty('country')]
    public ?string $country;

    /**
     * @var ?DateTime $created Creation timestamp
     */
    #[JsonProperty('created'), Date(Date::TYPE_DATETIME)]
    public ?DateTime $created;

    /**
     * @var ?array<string, mixed> $customerConsent Customer consent information
     */
    #[JsonProperty('customerConsent'), ArrayType(['string' => 'mixed'])]
    public ?array $customerConsent;

    /**
     * @var ?array<mixed> $customerEvents Events recorded for the customer.
     */
    #[JsonProperty('customerEvents'), ArrayType(['mixed'])]
    public ?array $customerEvents;

    /**
     * @var ?int $customerId
     */
    #[JsonProperty('customerId')]
    public ?int $customerId;

    /**
     * @var ?string $customerNumber
     */
    #[JsonProperty('customerNumber')]
    public ?string $customerNumber;

    /**
     * @var ?string $customerPortal
     */
    #[JsonProperty('customerPortal')]
    public ?string $customerPortal;

    /**
     * @var ?int $customerStatus Status code for the customer
     */
    #[JsonProperty('customerStatus')]
    public ?int $customerStatus;

    /**
     * @var ?CustomerSummaryRecord $customerSummary
     */
    #[JsonProperty('customerSummary')]
    public ?CustomerSummaryRecord $customerSummary;

    /**
     * @var ?string $customerUsername Username of the customer
     */
    #[JsonProperty('customerUsername')]
    public ?string $customerUsername;

    /**
     * @var ?string $email Customer email address.
     */
    #[JsonProperty('email')]
    public ?string $email;

    /**
     * @var ?string $externalPaypointId
     */
    #[JsonProperty('externalPaypointID')]
    public ?string $externalPaypointId;

    /**
     * @var ?string $firstname Customer first name.
     */
    #[JsonProperty('firstname')]
    public ?string $firstname;

    /**
     * @var ?array<string> $identifierFields
     */
    #[JsonProperty('identifierFields'), ArrayType(['string'])]
    public ?array $identifierFields;

    /**
     * @var ?string $lastname Customer last name.
     */
    #[JsonProperty('lastname')]
    public ?string $lastname;

    /**
     * @var ?DateTime $lastUpdated Last update timestamp
     */
    #[JsonProperty('lastUpdated'), Date(Date::TYPE_DATETIME)]
    public ?DateTime $lastUpdated;

    /**
     * @var ?bool $mfa Multi-factor authentication status
     */
    #[JsonProperty('mfa')]
    public ?bool $mfa;

    /**
     * @var ?int $mfaMode MFA mode setting
     */
    #[JsonProperty('mfaMode')]
    public ?int $mfaMode;

    /**
     * @var ?string $pageindentifier
     */
    #[JsonProperty('pageindentifier')]
    public ?string $pageindentifier;

    /**
     * @var ?int $parentOrgId Parent organization ID
     */
    #[JsonProperty('parentOrgId')]
    public ?int $parentOrgId;

    /**
     * @var ?string $parentOrgName
     */
    #[JsonProperty('parentOrgName')]
    public ?string $parentOrgName;

    /**
     * @var ?string $paypointDbaname
     */
    #[JsonProperty('paypointDbaname')]
    public ?string $paypointDbaname;

    /**
     * @var ?string $paypointEntryname The paypoint entryname the customer is associated with
     */
    #[JsonProperty('paypointEntryname')]
    public ?string $paypointEntryname;

    /**
     * @var ?string $paypointLegalname
     */
    #[JsonProperty('paypointLegalname')]
    public ?string $paypointLegalname;

    /**
     * @var ?string $phone Customer phone number.
     */
    #[JsonProperty('phone')]
    public ?string $phone;

    /**
     * @var ?string $shippingAddress
     */
    #[JsonProperty('shippingAddress')]
    public ?string $shippingAddress;

    /**
     * @var ?string $shippingAddress1
     */
    #[JsonProperty('shippingAddress1')]
    public ?string $shippingAddress1;

    /**
     * @var ?string $shippingCity
     */
    #[JsonProperty('shippingCity')]
    public ?string $shippingCity;

    /**
     * @var ?string $shippingCountry
     */
    #[JsonProperty('shippingCountry')]
    public ?string $shippingCountry;

    /**
     * @var ?string $shippingState
     */
    #[JsonProperty('shippingState')]
    public ?string $shippingState;

    /**
     * @var ?string $shippingZip
     */
    #[JsonProperty('shippingZip')]
    public ?string $shippingZip;

    /**
     * @var ?array<string, mixed> $snData Social network data
     */
    #[JsonProperty('snData'), ArrayType(['string' => 'mixed'])]
    public ?array $snData;

    /**
     * @var ?string $snIdentifier Social network identifier
     */
    #[JsonProperty('snIdentifier')]
    public ?string $snIdentifier;

    /**
     * @var ?string $snProvider Social network provider
     */
    #[JsonProperty('snProvider')]
    public ?string $snProvider;

    /**
     * @var ?string $state Customer state.
     */
    #[JsonProperty('state')]
    public ?string $state;

    /**
     * @var ?array<MethodQueryRecords> $storedMethods List of payment methods associated to the customer
     */
    #[JsonProperty('storedMethods'), ArrayType([MethodQueryRecords::class])]
    public ?array $storedMethods;

    /**
     * @var ?array<SubscriptionQueryRecords> $subscriptions List of subscriptions associated to the customer
     */
    #[JsonProperty('subscriptions'), ArrayType([SubscriptionQueryRecords::class])]
    public ?array $subscriptions;

    /**
     * @var ?int $timeZone Customer's timezone
     */
    #[JsonProperty('timeZone')]
    public ?int $timeZone;

    /**
     * @var ?string $zip Customer postal code.
     */
    #[JsonProperty('zip')]
    public ?string $zip;

    /**
     * @param array{
     *   additionalFields?: ?array<string, string>,
     *   address?: ?string,
     *   address1?: ?string,
     *   balance?: ?float,
     *   city?: ?string,
     *   company?: ?string,
     *   country?: ?string,
     *   created?: ?DateTime,
     *   customerConsent?: ?array<string, mixed>,
     *   customerEvents?: ?array<mixed>,
     *   customerId?: ?int,
     *   customerNumber?: ?string,
     *   customerPortal?: ?string,
     *   customerStatus?: ?int,
     *   customerSummary?: ?CustomerSummaryRecord,
     *   customerUsername?: ?string,
     *   email?: ?string,
     *   externalPaypointId?: ?string,
     *   firstname?: ?string,
     *   identifierFields?: ?array<string>,
     *   lastname?: ?string,
     *   lastUpdated?: ?DateTime,
     *   mfa?: ?bool,
     *   mfaMode?: ?int,
     *   pageindentifier?: ?string,
     *   parentOrgId?: ?int,
     *   parentOrgName?: ?string,
     *   paypointDbaname?: ?string,
     *   paypointEntryname?: ?string,
     *   paypointLegalname?: ?string,
     *   phone?: ?string,
     *   shippingAddress?: ?string,
     *   shippingAddress1?: ?string,
     *   shippingCity?: ?string,
     *   shippingCountry?: ?string,
     *   shippingState?: ?string,
     *   shippingZip?: ?string,
     *   snData?: ?array<string, mixed>,
     *   snIdentifier?: ?string,
     *   snProvider?: ?string,
     *   state?: ?string,
     *   storedMethods?: ?array<MethodQueryRecords>,
     *   subscriptions?: ?array<SubscriptionQueryRecords>,
     *   timeZone?: ?int,
     *   zip?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->additionalFields = $values['additionalFields'] ?? null;
        $this->address = $values['address'] ?? null;
        $this->address1 = $values['address1'] ?? null;
        $this->balance = $values['balance'] ?? null;
        $this->city = $values['city'] ?? null;
        $this->company = $values['company'] ?? null;
        $this->country = $values['country'] ?? null;
        $this->created = $values['created'] ?? null;
        $this->customerConsent = $values['customerConsent'] ?? null;
        $this->customerEvents = $values['customerEvents'] ?? null;
        $this->customerId = $values['customerId'] ?? null;
        $this->customerNumber = $values['customerNumber'] ?? null;
        $this->customerPortal = $values['customerPortal'] ?? null;
        $this->customerStatus = $values['customerStatus'] ?? null;
        $this->customerSummary = $values['customerSummary'] ?? null;
        $this->customerUsername = $values['customerUsername'] ?? null;
        $this->email = $values['email'] ?? null;
        $this->externalPaypointId = $values['externalPaypointId'] ?? null;
        $this->firstname = $values['firstname'] ?? null;
        $this->identifierFields = $values['identifierFields'] ?? null;
        $this->lastname = $values['lastname'] ?? null;
        $this->lastUpdated = $values['lastUpdated'] ?? null;
        $this->mfa = $values['mfa'] ?? null;
        $this->mfaMode = $values['mfaMode'] ?? null;
        $this->pageindentifier = $values['pageindentifier'] ?? null;
        $this->parentOrgId = $values['parentOrgId'] ?? null;
        $this->parentOrgName = $values['parentOrgName'] ?? null;
        $this->paypointDbaname = $values['paypointDbaname'] ?? null;
        $this->paypointEntryname = $values['paypointEntryname'] ?? null;
        $this->paypointLegalname = $values['paypointLegalname'] ?? null;
        $this->phone = $values['phone'] ?? null;
        $this->shippingAddress = $values['shippingAddress'] ?? null;
        $this->shippingAddress1 = $values['shippingAddress1'] ?? null;
        $this->shippingCity = $values['shippingCity'] ?? null;
        $this->shippingCountry = $values['shippingCountry'] ?? null;
        $this->shippingState = $values['shippingState'] ?? null;
        $this->shippingZip = $values['shippingZip'] ?? null;
        $this->snData = $values['snData'] ?? null;
        $this->snIdentifier = $values['snIdentifier'] ?? null;
        $this->snProvider = $values['snProvider'] ?? null;
        $this->state = $values['state'] ?? null;
        $this->storedMethods = $values['storedMethods'] ?? null;
        $this->subscriptions = $values['subscriptions'] ?? null;
        $this->timeZone = $values['timeZone'] ?? null;
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
