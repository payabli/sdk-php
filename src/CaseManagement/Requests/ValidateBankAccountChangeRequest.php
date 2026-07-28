<?php

namespace Payabli\CaseManagement\Requests;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Types\CaseManagementBankAccountFunction;
use Payabli\Types\BankAccountServices;

class ValidateBankAccountChangeRequest extends JsonSerializableType
{
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
     * @param array{
     *   routingNumber: string,
     *   accountNumber: string,
     *   accountType: string,
     *   bankAccountHolderType: string,
     *   bankAccountFunction: value-of<CaseManagementBankAccountFunction>,
     *   services: BankAccountServices,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->routingNumber = $values['routingNumber'];
        $this->accountNumber = $values['accountNumber'];
        $this->accountType = $values['accountType'];
        $this->bankAccountHolderType = $values['bankAccountHolderType'];
        $this->bankAccountFunction = $values['bankAccountFunction'];
        $this->services = $values['services'];
    }
}
