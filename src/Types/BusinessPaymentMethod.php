<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Core\Types\ArrayType;

/**
 * A bank account or card attached to a business.
 */
class BusinessPaymentMethod extends JsonSerializableType
{
    /**
     * @var ?string $type The payment method type, for example a bank account or card.
     */
    #[JsonProperty('type')]
    public ?string $type;

    /**
     * @var ?string $accountOwner The name of the account owner.
     */
    #[JsonProperty('accountOwner')]
    public ?string $accountOwner;

    /**
     * @var ?string $name An optional label for the payment method.
     */
    #[JsonProperty('name')]
    public ?string $name;

    /**
     * @var ?string $financialInstitution The bank or financial institution that holds the account.
     */
    #[JsonProperty('financialInstitution')]
    public ?string $financialInstitution;

    /**
     * @var ?string $ownerType Whether the owner is a business or an individual.
     */
    #[JsonProperty('ownerType')]
    public ?string $ownerType;

    /**
     * @var ?string $accountType The account type, for example checking or savings.
     */
    #[JsonProperty('accountType')]
    public ?string $accountType;

    /**
     * @var ?string $accountNumber The bank account number.
     */
    #[JsonProperty('accountNumber')]
    public ?string $accountNumber;

    /**
     * @var ?string $routingNumber The bank routing number.
     */
    #[JsonProperty('routingNumber')]
    public ?string $routingNumber;

    /**
     * @var ?string $cardNumber The card number, for card payment methods.
     */
    #[JsonProperty('cardNumber')]
    public ?string $cardNumber;

    /**
     * @var ?string $expirationDate The card expiration date, for card payment methods.
     */
    #[JsonProperty('expirationDate')]
    public ?string $expirationDate;

    /**
     * @var ?string $cvv The card verification value, for card payment methods.
     */
    #[JsonProperty('cvv')]
    public ?string $cvv;

    /**
     * @var ?string $cardType The card type, for card payment methods.
     */
    #[JsonProperty('cardType')]
    public ?string $cardType;

    /**
     * @var ?array<string> $usage What the payment method is used for.
     */
    #[JsonProperty('usage'), ArrayType(['string'])]
    public ?array $usage;

    /**
     * Whether this is the owner's default payment method. At most one payment
     * method per owner can set `isDefault` to `true`; sending two `true` values
     * in one request fails validation.
     *
     * @var ?bool $isDefault
     */
    #[JsonProperty('isDefault')]
    public ?bool $isDefault;

    /**
     * @param array{
     *   type?: ?string,
     *   accountOwner?: ?string,
     *   name?: ?string,
     *   financialInstitution?: ?string,
     *   ownerType?: ?string,
     *   accountType?: ?string,
     *   accountNumber?: ?string,
     *   routingNumber?: ?string,
     *   cardNumber?: ?string,
     *   expirationDate?: ?string,
     *   cvv?: ?string,
     *   cardType?: ?string,
     *   usage?: ?array<string>,
     *   isDefault?: ?bool,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->type = $values['type'] ?? null;
        $this->accountOwner = $values['accountOwner'] ?? null;
        $this->name = $values['name'] ?? null;
        $this->financialInstitution = $values['financialInstitution'] ?? null;
        $this->ownerType = $values['ownerType'] ?? null;
        $this->accountType = $values['accountType'] ?? null;
        $this->accountNumber = $values['accountNumber'] ?? null;
        $this->routingNumber = $values['routingNumber'] ?? null;
        $this->cardNumber = $values['cardNumber'] ?? null;
        $this->expirationDate = $values['expirationDate'] ?? null;
        $this->cvv = $values['cvv'] ?? null;
        $this->cardType = $values['cardType'] ?? null;
        $this->usage = $values['usage'] ?? null;
        $this->isDefault = $values['isDefault'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
