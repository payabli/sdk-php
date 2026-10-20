<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Core\Types\ArrayType;
use DateTime;
use Payabli\Core\Types\Date;

/**
 * A payment method as returned by create, update, and deactivate. Sensitive fields are masked.
 */
class PaymentMethodResult extends JsonSerializableType
{
    /**
     * @var string $paymentMethodReference The payment method reference, used to read and manage the payment method.
     */
    #[JsonProperty('paymentMethodReference')]
    public string $paymentMethodReference;

    /**
     * @var string $type The payment method type.
     */
    #[JsonProperty('type')]
    public string $type;

    /**
     * @var ?string $fingerprint A hash that uniquely identifies the underlying account, used to detect duplicates.
     */
    #[JsonProperty('fingerprint')]
    public ?string $fingerprint;

    /**
     * @var ?string $tokenReference The reference of the stored token for the payment method.
     */
    #[JsonProperty('tokenReference')]
    public ?string $tokenReference;

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
     * @var DateTime $createdAt When the payment method was created.
     */
    #[JsonProperty('createdAt'), Date(Date::TYPE_DATETIME)]
    public DateTime $createdAt;

    /**
     * @var DateTime $lastUpdated When the payment method was last updated.
     */
    #[JsonProperty('lastUpdated'), Date(Date::TYPE_DATETIME)]
    public DateTime $lastUpdated;

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
     *   createdAt: DateTime,
     *   lastUpdated: DateTime,
     *   links: PaymentMethodLinks,
     *   fingerprint?: ?string,
     *   tokenReference?: ?string,
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
        $this->paymentMethodReference = $values['paymentMethodReference'];
        $this->type = $values['type'];
        $this->fingerprint = $values['fingerprint'] ?? null;
        $this->tokenReference = $values['tokenReference'] ?? null;
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
