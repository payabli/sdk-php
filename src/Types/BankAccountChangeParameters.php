<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * The bank-account-change details stored on a case. The raw account and
 * routing numbers are write-only and never appear here — only a vault token
 * (`bankToken`) and non-sensitive details.
 */
class BankAccountChangeParameters extends JsonSerializableType
{
    /**
     * @var value-of<BankAccountChangeParametersType> $type The parameters type discriminator.
     */
    #[JsonProperty('type')]
    public string $type;

    /**
     * @var string $nickname A label for the account.
     */
    #[JsonProperty('nickname')]
    public string $nickname;

    /**
     * @var string $bankName The name of the bank.
     */
    #[JsonProperty('bankName')]
    public string $bankName;

    /**
     * @var string $bankToken A vault token referencing the tokenized bank account. The raw account and routing numbers are never returned.
     */
    #[JsonProperty('bankToken')]
    public string $bankToken;

    /**
     * @var string $accountType The account type, such as `Checking` or `Savings`.
     */
    #[JsonProperty('accountType')]
    public string $accountType;

    /**
     * @var string $bankAccountHolderName The account holder's name, taken from the paypoint's legal name.
     */
    #[JsonProperty('bankAccountHolderName')]
    public string $bankAccountHolderName;

    /**
     * @var string $bankAccountHolderType The account holder type, such as `personal` or `business`.
     */
    #[JsonProperty('bankAccountHolderType')]
    public string $bankAccountHolderType;

    /**
     * @var value-of<CaseManagementBankAccountFunction> $bankAccountFunction
     */
    #[JsonProperty('bankAccountFunction')]
    public string $bankAccountFunction;

    /**
     * @var BankAccountServices $services
     */
    #[JsonProperty('services')]
    public BankAccountServices $services;

    /**
     * @var bool $default Whether this is the default account for the selected services.
     */
    #[JsonProperty('default')]
    public bool $default;

    /**
     * @param array{
     *   type: value-of<BankAccountChangeParametersType>,
     *   nickname: string,
     *   bankName: string,
     *   bankToken: string,
     *   accountType: string,
     *   bankAccountHolderName: string,
     *   bankAccountHolderType: string,
     *   bankAccountFunction: value-of<CaseManagementBankAccountFunction>,
     *   services: BankAccountServices,
     *   default: bool,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->type = $values['type'];
        $this->nickname = $values['nickname'];
        $this->bankName = $values['bankName'];
        $this->bankToken = $values['bankToken'];
        $this->accountType = $values['accountType'];
        $this->bankAccountHolderName = $values['bankAccountHolderName'];
        $this->bankAccountHolderType = $values['bankAccountHolderType'];
        $this->bankAccountFunction = $values['bankAccountFunction'];
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
