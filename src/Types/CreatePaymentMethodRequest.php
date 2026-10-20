<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Core\Types\ArrayType;

/**
 * A single payment method to create.
 */
class CreatePaymentMethodRequest extends JsonSerializableType
{
    /**
     * @var value-of<CreatePaymentMethodRequestType> $type The payment method type.
     */
    #[JsonProperty('type')]
    public string $type;

    /**
     * @var string $accountOwner The reference of the person or business that owns the payment method (for example, a business `businessUuid` or a person `personReference`).
     */
    #[JsonProperty('accountOwner')]
    public string $accountOwner;

    /**
     * @var value-of<PaymentMethodOwnerType> $ownerType Whether the owner is a `person` or a `business`.
     */
    #[JsonProperty('ownerType')]
    public string $ownerType;

    /**
     * @var ?string $nickname An optional label for the payment method.
     */
    #[JsonProperty('nickname')]
    public ?string $nickname;

    /**
     * @var ?string $financialInstitution The bank or financial institution that holds the account.
     */
    #[JsonProperty('financialInstitution')]
    public ?string $financialInstitution;

    /**
     * @var string $accountType The account type, for example `checking` or `savings`.
     */
    #[JsonProperty('accountType')]
    public string $accountType;

    /**
     * @var string $accountNumber The bank account number.
     */
    #[JsonProperty('accountNumber')]
    public string $accountNumber;

    /**
     * @var string $routingNumber The bank routing number.
     */
    #[JsonProperty('routingNumber')]
    public string $routingNumber;

    /**
     * @var array<value-of<PaymentMethodUsage>> $usage What the payment method is used for. Provide at least one value.
     */
    #[JsonProperty('usage'), ArrayType(['string'])]
    public array $usage;

    /**
     * When `true`, makes this the owner's default payment method. If the owner
     * already has a default, this payment method replaces it.
     *
     * @var ?bool $isDefault
     */
    #[JsonProperty('isDefault')]
    public ?bool $isDefault;

    /**
     * @param array{
     *   type: value-of<CreatePaymentMethodRequestType>,
     *   accountOwner: string,
     *   ownerType: value-of<PaymentMethodOwnerType>,
     *   accountType: string,
     *   accountNumber: string,
     *   routingNumber: string,
     *   usage: array<value-of<PaymentMethodUsage>>,
     *   nickname?: ?string,
     *   financialInstitution?: ?string,
     *   isDefault?: ?bool,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->type = $values['type'];
        $this->accountOwner = $values['accountOwner'];
        $this->ownerType = $values['ownerType'];
        $this->nickname = $values['nickname'] ?? null;
        $this->financialInstitution = $values['financialInstitution'] ?? null;
        $this->accountType = $values['accountType'];
        $this->accountNumber = $values['accountNumber'];
        $this->routingNumber = $values['routingNumber'];
        $this->usage = $values['usage'];
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
