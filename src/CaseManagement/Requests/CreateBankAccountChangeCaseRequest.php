<?php

namespace Payabli\CaseManagement\Requests;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Types\CaseManagementBankAccountFunction;
use Payabli\Types\BankAccountServices;
use DateTime;
use Payabli\Core\Types\Date;

class CreateBankAccountChangeCaseRequest extends JsonSerializableType
{
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
     * @var string $routingNumber The 9-digit bank routing number.
     */
    #[JsonProperty('routingNumber')]
    public string $routingNumber;

    /**
     * @var string $accountNumber The bank account number (4 to 17 digits).
     */
    #[JsonProperty('accountNumber')]
    public string $accountNumber;

    /**
     * @var string $accountType The account type. Must be `checking` or `savings`.
     */
    #[JsonProperty('accountType')]
    public string $accountType;

    /**
     * @var string $bankAccountHolderType The account holder type. Must be `personal` or `business`.
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
     * When to run the change, as a UTC timestamp (trailing `Z`). Must be at
     * least 1 hour and at most 30 days in the future. Omit to run as soon as
     * the case is approved.
     *
     * @var ?DateTime $scheduleFor
     */
    #[JsonProperty('scheduleFor'), Date(Date::TYPE_DATETIME)]
    public ?DateTime $scheduleFor;

    /**
     * @param array{
     *   nickname: string,
     *   bankName: string,
     *   routingNumber: string,
     *   accountNumber: string,
     *   accountType: string,
     *   bankAccountHolderType: string,
     *   bankAccountFunction: value-of<CaseManagementBankAccountFunction>,
     *   services: BankAccountServices,
     *   default: bool,
     *   scheduleFor?: ?DateTime,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->nickname = $values['nickname'];
        $this->bankName = $values['bankName'];
        $this->routingNumber = $values['routingNumber'];
        $this->accountNumber = $values['accountNumber'];
        $this->accountType = $values['accountType'];
        $this->bankAccountHolderType = $values['bankAccountHolderType'];
        $this->bankAccountFunction = $values['bankAccountFunction'];
        $this->services = $values['services'];
        $this->default = $values['default'];
        $this->scheduleFor = $values['scheduleFor'] ?? null;
    }
}
