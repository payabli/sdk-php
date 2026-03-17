<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Core\Types\ArrayType;

class BillingDataResponse extends JsonSerializableType
{
    /**
     * @var int $id The bank's ID in Payabli.
     */
    #[JsonProperty('id')]
    public int $id;

    /**
     * @var ?string $accountId An identifier for the bank account. If not provided during creation or update, the system generates one in the format `acct-{first_digit}xxxxx{last_4_digits}` based on the account number. If a duplicate exists within the same service at the paypoint, a numeric suffix is appended, such as `-2`. This value is also used as the identifier for the bank account's associated payment connector.
     */
    #[JsonProperty('accountId')]
    public ?string $accountId;

    /**
     * @var string $nickname
     */
    #[JsonProperty('nickname')]
    public string $nickname;

    /**
     * @var string $bankName
     */
    #[JsonProperty('bankName')]
    public string $bankName;

    /**
     * @var string $routingAccount
     */
    #[JsonProperty('routingAccount')]
    public string $routingAccount;

    /**
     * @var string $accountNumber
     */
    #[JsonProperty('accountNumber')]
    public string $accountNumber;

    /**
     * @var value-of<TypeAccount> $typeAccount
     */
    #[JsonProperty('typeAccount')]
    public string $typeAccount;

    /**
     * @var string $bankAccountHolderName
     */
    #[JsonProperty('bankAccountHolderName')]
    public string $bankAccountHolderName;

    /**
     * @var value-of<BankAccountHolderType> $bankAccountHolderType
     */
    #[JsonProperty('bankAccountHolderType')]
    public string $bankAccountHolderType;

    /**
     * Describes whether the bank account is used for deposits or withdrawals in Payabli:
     *   - `0`: Deposit
     *   - `1`: Withdrawal
     *   - `2`: Deposit and withdrawal
     *
     * @var int $bankAccountFunction
     */
    #[JsonProperty('bankAccountFunction')]
    public int $bankAccountFunction;

    /**
     * @var bool $verified
     */
    #[JsonProperty('verified')]
    public bool $verified;

    /**
     * @var int $status
     */
    #[JsonProperty('status')]
    public int $status;

    /**
     * @var array<mixed> $services
     */
    #[JsonProperty('services'), ArrayType(['mixed'])]
    public array $services;

    /**
     * @var bool $default
     */
    #[JsonProperty('default')]
    public bool $default;

    /**
     * @param array{
     *   id: int,
     *   nickname: string,
     *   bankName: string,
     *   routingAccount: string,
     *   accountNumber: string,
     *   typeAccount: value-of<TypeAccount>,
     *   bankAccountHolderName: string,
     *   bankAccountHolderType: value-of<BankAccountHolderType>,
     *   bankAccountFunction: int,
     *   verified: bool,
     *   status: int,
     *   services: array<mixed>,
     *   default: bool,
     *   accountId?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->id = $values['id'];
        $this->accountId = $values['accountId'] ?? null;
        $this->nickname = $values['nickname'];
        $this->bankName = $values['bankName'];
        $this->routingAccount = $values['routingAccount'];
        $this->accountNumber = $values['accountNumber'];
        $this->typeAccount = $values['typeAccount'];
        $this->bankAccountHolderName = $values['bankAccountHolderName'];
        $this->bankAccountHolderType = $values['bankAccountHolderType'];
        $this->bankAccountFunction = $values['bankAccountFunction'];
        $this->verified = $values['verified'];
        $this->status = $values['status'];
        $this->services = $values['services'];
        $this->default = $values['default'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
