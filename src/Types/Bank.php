<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Core\Types\ArrayType;

/**
 * Object that contains bank account details.
 */
class Bank extends JsonSerializableType
{
    /**
     * @var ?int $id The Payabli-assigned internal identifier for the bank account.
     */
    #[JsonProperty('id')]
    public ?int $id;

    /**
     * @var ?string $accountId An identifier for the bank account, used to specify which account handles payments when multiple accounts are configured. If not provided during creation or update, the system generates one in the format `acct-{first_digit}xxxxx{last_4_digits}` based on the account number. The mask always uses five `x` characters regardless of account number length. For example, account number `123456789` produces `acct-1xxxxx6789`. If a duplicate exists within the same service at the paypoint, a numeric suffix is appended, such as `acct-1xxxxx6789-2`. This value is also used as the identifier for the bank account's associated payment connector.
     */
    #[JsonProperty('accountId')]
    public ?string $accountId;

    /**
     * @var ?string $nickname
     */
    #[JsonProperty('nickname')]
    public ?string $nickname;

    /**
     * @var ?string $bankName
     */
    #[JsonProperty('bankName')]
    public ?string $bankName;

    /**
     * @var ?string $routingAccount
     */
    #[JsonProperty('routingAccount')]
    public ?string $routingAccount;

    /**
     * @var ?string $accountNumber
     */
    #[JsonProperty('accountNumber')]
    public ?string $accountNumber;

    /**
     * @var ?value-of<TypeAccount> $typeAccount
     */
    #[JsonProperty('typeAccount')]
    public ?string $typeAccount;

    /**
     * @var ?string $bankAccountHolderName
     */
    #[JsonProperty('bankAccountHolderName')]
    public ?string $bankAccountHolderName;

    /**
     * @var ?value-of<BankAccountHolderType> $bankAccountHolderType
     */
    #[JsonProperty('bankAccountHolderType')]
    public ?string $bankAccountHolderType;

    /**
     * @var ?int $bankAccountFunction
     */
    #[JsonProperty('bankAccountFunction')]
    public ?int $bankAccountFunction;

    /**
     * @var ?bool $verified Bank account verification status. When `true`, the account has been verified to exist and be in good standing based on vendor checks or previous processing histories.
     */
    #[JsonProperty('verified')]
    public ?bool $verified;

    /**
     * @var ?int $status Bank account status
     */
    #[JsonProperty('status')]
    public ?int $status;

    /**
     * @var ?array<string> $services Array of services associated with this bank account
     */
    #[JsonProperty('services'), ArrayType(['string'])]
    public ?array $services;

    /**
     * @param array{
     *   id?: ?int,
     *   accountId?: ?string,
     *   nickname?: ?string,
     *   bankName?: ?string,
     *   routingAccount?: ?string,
     *   accountNumber?: ?string,
     *   typeAccount?: ?value-of<TypeAccount>,
     *   bankAccountHolderName?: ?string,
     *   bankAccountHolderType?: ?value-of<BankAccountHolderType>,
     *   bankAccountFunction?: ?int,
     *   verified?: ?bool,
     *   status?: ?int,
     *   services?: ?array<string>,
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
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
