<?php

namespace Payabli\MoneyOut\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * Billing data for the vendor.
 */
class VCardGetResponseAssociatedVendorBillingData extends JsonSerializableType
{
    /**
     * @var ?string $accountNumber Masked account number for transactions.
     */
    #[JsonProperty('accountNumber')]
    public ?string $accountNumber;

    /**
     * @var ?int $bankAccountFunction Function of the bank account.
     */
    #[JsonProperty('bankAccountFunction')]
    public ?int $bankAccountFunction;

    /**
     * @var ?string $bankAccountHolderName Name of the bank account holder.
     */
    #[JsonProperty('bankAccountHolderName')]
    public ?string $bankAccountHolderName;

    /**
     * @var ?string $bankAccountHolderType Type of bank account holder.
     */
    #[JsonProperty('bankAccountHolderType')]
    public ?string $bankAccountHolderType;

    /**
     * @var ?string $bankName Name of the bank used for transactions.
     */
    #[JsonProperty('bankName')]
    public ?string $bankName;

    /**
     * @var ?string $id Unique identifier for billing data.
     */
    #[JsonProperty('id')]
    public ?string $id;

    /**
     * @var ?string $routingAccount Routing number for the bank account.
     */
    #[JsonProperty('routingAccount')]
    public ?string $routingAccount;

    /**
     * @var ?string $typeAccount Type of the bank account.
     */
    #[JsonProperty('typeAccount')]
    public ?string $typeAccount;

    /**
     * @param array{
     *   accountNumber?: ?string,
     *   bankAccountFunction?: ?int,
     *   bankAccountHolderName?: ?string,
     *   bankAccountHolderType?: ?string,
     *   bankName?: ?string,
     *   id?: ?string,
     *   routingAccount?: ?string,
     *   typeAccount?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->accountNumber = $values['accountNumber'] ?? null;
        $this->bankAccountFunction = $values['bankAccountFunction'] ?? null;
        $this->bankAccountHolderName = $values['bankAccountHolderName'] ?? null;
        $this->bankAccountHolderType = $values['bankAccountHolderType'] ?? null;
        $this->bankName = $values['bankName'] ?? null;
        $this->id = $values['id'] ?? null;
        $this->routingAccount = $values['routingAccount'] ?? null;
        $this->typeAccount = $values['typeAccount'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
