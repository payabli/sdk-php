<?php

namespace Payabli\MoneyIn\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Core\Types\ArrayType;
use Payabli\Core\Types\Union;

/**
 * Customer information associated with the transaction
 */
class TransactionDetailCustomer extends JsonSerializableType
{
    /**
     * @var ?array<?string> $identifiers
     */
    #[JsonProperty('identifiers'), ArrayType([new Union('string', 'null')])]
    public ?array $identifiers;

    /**
     * @var string $firstName
     */
    #[JsonProperty('firstName')]
    public string $firstName;

    /**
     * @var string $lastName
     */
    #[JsonProperty('lastName')]
    public string $lastName;

    /**
     * @var string $companyName
     */
    #[JsonProperty('companyName')]
    public string $companyName;

    /**
     * @var string $billingAddress1
     */
    #[JsonProperty('billingAddress1')]
    public string $billingAddress1;

    /**
     * @var string $billingAddress2
     */
    #[JsonProperty('billingAddress2')]
    public string $billingAddress2;

    /**
     * @var string $billingCity
     */
    #[JsonProperty('billingCity')]
    public string $billingCity;

    /**
     * @var string $billingState
     */
    #[JsonProperty('billingState')]
    public string $billingState;

    /**
     * @var string $billingZip
     */
    #[JsonProperty('billingZip')]
    public string $billingZip;

    /**
     * @var string $billingCountry
     */
    #[JsonProperty('billingCountry')]
    public string $billingCountry;

    /**
     * @var string $billingPhone
     */
    #[JsonProperty('billingPhone')]
    public string $billingPhone;

    /**
     * @var string $billingEmail
     */
    #[JsonProperty('billingEmail')]
    public string $billingEmail;

    /**
     * @var string $customerNumber
     */
    #[JsonProperty('customerNumber')]
    public string $customerNumber;

    /**
     * @var string $shippingAddress1
     */
    #[JsonProperty('shippingAddress1')]
    public string $shippingAddress1;

    /**
     * @var string $shippingAddress2
     */
    #[JsonProperty('shippingAddress2')]
    public string $shippingAddress2;

    /**
     * @var string $shippingCity
     */
    #[JsonProperty('shippingCity')]
    public string $shippingCity;

    /**
     * @var string $shippingState
     */
    #[JsonProperty('shippingState')]
    public string $shippingState;

    /**
     * @var string $shippingZip
     */
    #[JsonProperty('shippingZip')]
    public string $shippingZip;

    /**
     * @var string $shippingCountry
     */
    #[JsonProperty('shippingCountry')]
    public string $shippingCountry;

    /**
     * @var int $customerId
     */
    #[JsonProperty('customerId')]
    public int $customerId;

    /**
     * @var int $customerStatus
     */
    #[JsonProperty('customerStatus')]
    public int $customerStatus;

    /**
     * @var ?string $additionalData
     */
    #[JsonProperty('additionalData')]
    public ?string $additionalData;

    /**
     * @param array{
     *   firstName: string,
     *   lastName: string,
     *   companyName: string,
     *   billingAddress1: string,
     *   billingAddress2: string,
     *   billingCity: string,
     *   billingState: string,
     *   billingZip: string,
     *   billingCountry: string,
     *   billingPhone: string,
     *   billingEmail: string,
     *   customerNumber: string,
     *   shippingAddress1: string,
     *   shippingAddress2: string,
     *   shippingCity: string,
     *   shippingState: string,
     *   shippingZip: string,
     *   shippingCountry: string,
     *   customerId: int,
     *   customerStatus: int,
     *   identifiers?: ?array<?string>,
     *   additionalData?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->identifiers = $values['identifiers'] ?? null;
        $this->firstName = $values['firstName'];
        $this->lastName = $values['lastName'];
        $this->companyName = $values['companyName'];
        $this->billingAddress1 = $values['billingAddress1'];
        $this->billingAddress2 = $values['billingAddress2'];
        $this->billingCity = $values['billingCity'];
        $this->billingState = $values['billingState'];
        $this->billingZip = $values['billingZip'];
        $this->billingCountry = $values['billingCountry'];
        $this->billingPhone = $values['billingPhone'];
        $this->billingEmail = $values['billingEmail'];
        $this->customerNumber = $values['customerNumber'];
        $this->shippingAddress1 = $values['shippingAddress1'];
        $this->shippingAddress2 = $values['shippingAddress2'];
        $this->shippingCity = $values['shippingCity'];
        $this->shippingState = $values['shippingState'];
        $this->shippingZip = $values['shippingZip'];
        $this->shippingCountry = $values['shippingCountry'];
        $this->customerId = $values['customerId'];
        $this->customerStatus = $values['customerStatus'];
        $this->additionalData = $values['additionalData'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
