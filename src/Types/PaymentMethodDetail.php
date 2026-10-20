<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Core\Types\ArrayType;

/**
 * A payment method as returned by read and list. Sensitive fields are masked.
 */
class PaymentMethodDetail extends JsonSerializableType
{
    /**
     * @var ?bool $isDefault Whether this is the owner's default payment method. Returned when you list payment methods, but not when you get a single payment method.
     */
    #[JsonProperty('isDefault')]
    public ?bool $isDefault;

    /**
     * @var string $paymentMethodReference The payment method reference.
     */
    #[JsonProperty('paymentMethodReference')]
    public string $paymentMethodReference;

    /**
     * @var string $type The payment method type.
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
     * @var ?string $accountType The account type.
     */
    #[JsonProperty('accountType')]
    public ?string $accountType;

    /**
     * @var ?string $accountNumber The bank account number, masked (only the last four digits are shown).
     */
    #[JsonProperty('accountNumber')]
    public ?string $accountNumber;

    /**
     * @var ?string $routingNumber The bank routing number, masked.
     */
    #[JsonProperty('routingNumber')]
    public ?string $routingNumber;

    /**
     * @var string $status The payment method's current status.
     */
    #[JsonProperty('status')]
    public string $status;

    /**
     * @var ?array<value-of<PaymentMethodUsage>> $usage What the payment method is used for.
     */
    #[JsonProperty('usage'), ArrayType(['string'])]
    public ?array $usage;

    /**
     * @var string $createdAt When the payment method was created.
     */
    #[JsonProperty('createdAt')]
    public string $createdAt;

    /**
     * @var string $lastUpdated When the payment method was last updated.
     */
    #[JsonProperty('lastUpdated')]
    public string $lastUpdated;

    /**
     * @var PaymentMethodLinks $links Hypermedia links for the payment method resource.
     */
    #[JsonProperty('_links')]
    public PaymentMethodLinks $links;

    /**
     * @param array{
     *   paymentMethodReference: string,
     *   type: string,
     *   accountOwner: string,
     *   ownerType: value-of<PaymentMethodOwnerType>,
     *   status: string,
     *   createdAt: string,
     *   lastUpdated: string,
     *   links: PaymentMethodLinks,
     *   isDefault?: ?bool,
     *   nickname?: ?string,
     *   financialInstitution?: ?string,
     *   accountType?: ?string,
     *   accountNumber?: ?string,
     *   routingNumber?: ?string,
     *   usage?: ?array<value-of<PaymentMethodUsage>>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->isDefault = $values['isDefault'] ?? null;
        $this->paymentMethodReference = $values['paymentMethodReference'];
        $this->type = $values['type'];
        $this->accountOwner = $values['accountOwner'];
        $this->ownerType = $values['ownerType'];
        $this->nickname = $values['nickname'] ?? null;
        $this->financialInstitution = $values['financialInstitution'] ?? null;
        $this->accountType = $values['accountType'] ?? null;
        $this->accountNumber = $values['accountNumber'] ?? null;
        $this->routingNumber = $values['routingNumber'] ?? null;
        $this->status = $values['status'];
        $this->usage = $values['usage'] ?? null;
        $this->createdAt = $values['createdAt'];
        $this->lastUpdated = $values['lastUpdated'];
        $this->links = $values['links'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
