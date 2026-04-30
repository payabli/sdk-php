<?php

namespace Payabli\Management\Requests;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

class VerifyAccountDetailsRequest extends JsonSerializableType
{
    /**
     * @var string $routingNumber The bank routing number to verify.
     */
    #[JsonProperty('routingNumber')]
    public string $routingNumber;

    /**
     * @var string $accountNumber The bank account number to verify.
     */
    #[JsonProperty('accountNumber')]
    public string $accountNumber;

    /**
     * @var ?string $accountType The type of bank account, such as `Checking` or `Savings`.
     */
    #[JsonProperty('accountType')]
    public ?string $accountType;

    /**
     * @var ?string $country The ISO country code for the bank account, such as `US`.
     */
    #[JsonProperty('country')]
    public ?string $country;

    /**
     * @var ?string $accountHolderType The type of account holder. Accepted values are `personal` or `business`. Required when bank authentication is enabled for the paypoint's organization.
     */
    #[JsonProperty('accountHolderType')]
    public ?string $accountHolderType;

    /**
     * @var ?string $holderName The name of the bank account holder. For personal accounts, provide the holder's full name (for example, `Jane Doe`); the value is split on the first space into first and last name. For business accounts, provide the legal business name. Required when bank authentication is enabled for the paypoint's organization.
     */
    #[JsonProperty('holderName')]
    public ?string $holderName;

    /**
     * @param array{
     *   routingNumber: string,
     *   accountNumber: string,
     *   accountType?: ?string,
     *   country?: ?string,
     *   accountHolderType?: ?string,
     *   holderName?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->routingNumber = $values['routingNumber'];
        $this->accountNumber = $values['accountNumber'];
        $this->accountType = $values['accountType'] ?? null;
        $this->country = $values['country'] ?? null;
        $this->accountHolderType = $values['accountHolderType'] ?? null;
        $this->holderName = $values['holderName'] ?? null;
    }
}
