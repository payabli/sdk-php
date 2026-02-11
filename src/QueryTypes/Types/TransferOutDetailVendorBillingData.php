<?php

namespace Payabli\QueryTypes\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Core\Types\ArrayType;

/**
 * Billing data for a vendor.
 */
class TransferOutDetailVendorBillingData extends JsonSerializableType
{
    /**
     * @var ?int $id Unique identifier for the billing data.
     */
    #[JsonProperty('id')]
    public ?int $id;

    /**
     * @var ?string $accountId The account ID.
     */
    #[JsonProperty('accountId')]
    public ?string $accountId;

    /**
     * @var ?string $nickname A nickname for the account.
     */
    #[JsonProperty('nickname')]
    public ?string $nickname;

    /**
     * @var ?string $bankName The name of the bank.
     */
    #[JsonProperty('bankName')]
    public ?string $bankName;

    /**
     * @var ?string $routingAccount The routing number.
     */
    #[JsonProperty('routingAccount')]
    public ?string $routingAccount;

    /**
     * @var ?string $accountNumber The account number.
     */
    #[JsonProperty('accountNumber')]
    public ?string $accountNumber;

    /**
     * @var ?string $typeAccount The type of account.
     */
    #[JsonProperty('typeAccount')]
    public ?string $typeAccount;

    /**
     * @var ?string $bankAccountHolderName The name of the account holder.
     */
    #[JsonProperty('bankAccountHolderName')]
    public ?string $bankAccountHolderName;

    /**
     * @var ?string $bankAccountHolderType The type of account holder.
     */
    #[JsonProperty('bankAccountHolderType')]
    public ?string $bankAccountHolderType;

    /**
     * @var ?int $bankAccountFunction The function of the bank account.
     */
    #[JsonProperty('bankAccountFunction')]
    public ?int $bankAccountFunction;

    /**
     * @var ?bool $verified Whether the account is verified.
     */
    #[JsonProperty('verified')]
    public ?bool $verified;

    /**
     * @var ?int $status The status of the billing data.
     */
    #[JsonProperty('status')]
    public ?int $status;

    /**
     * @var ?array<mixed> $services Services associated with the billing data.
     */
    #[JsonProperty('services'), ArrayType(['mixed'])]
    public ?array $services;

    /**
     * @var ?bool $default Whether this is the default billing data.
     */
    #[JsonProperty('default')]
    public ?bool $default;

    /**
     * @var ?string $country The country of the bank account.
     */
    #[JsonProperty('country')]
    public ?string $country;

    /**
     * @param array{
     *   id?: ?int,
     *   accountId?: ?string,
     *   nickname?: ?string,
     *   bankName?: ?string,
     *   routingAccount?: ?string,
     *   accountNumber?: ?string,
     *   typeAccount?: ?string,
     *   bankAccountHolderName?: ?string,
     *   bankAccountHolderType?: ?string,
     *   bankAccountFunction?: ?int,
     *   verified?: ?bool,
     *   status?: ?int,
     *   services?: ?array<mixed>,
     *   default?: ?bool,
     *   country?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->id = $values['id'] ?? null;
        $this->accountId = $values['accountId'] ?? null;
        $this->nickname = $values['nickname'] ?? null;
        $this->bankName = $values['bankName'] ?? null;
        $this->routingAccount = $values['routingAccount'] ?? null;
        $this->accountNumber = $values['accountNumber'] ?? null;
        $this->typeAccount = $values['typeAccount'] ?? null;
        $this->bankAccountHolderName = $values['bankAccountHolderName'] ?? null;
        $this->bankAccountHolderType = $values['bankAccountHolderType'] ?? null;
        $this->bankAccountFunction = $values['bankAccountFunction'] ?? null;
        $this->verified = $values['verified'] ?? null;
        $this->status = $values['status'] ?? null;
        $this->services = $values['services'] ?? null;
        $this->default = $values['default'] ?? null;
        $this->country = $values['country'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
