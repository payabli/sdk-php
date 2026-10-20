<?php

namespace Payabli\PaymentMethods\Requests;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Types\PaymentMethodUsage;
use Payabli\Core\Types\ArrayType;

class UpdatePaymentMethodRequest extends JsonSerializableType
{
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
     * @var ?string $accountType The account type, for example `checking` or `savings`.
     */
    #[JsonProperty('accountType')]
    public ?string $accountType;

    /**
     * @var ?string $accountNumber The bank account number.
     */
    #[JsonProperty('accountNumber')]
    public ?string $accountNumber;

    /**
     * @var ?string $routingNumber The bank routing number.
     */
    #[JsonProperty('routingNumber')]
    public ?string $routingNumber;

    /**
     * @var ?array<value-of<PaymentMethodUsage>> $usage What the payment method is used for. Provide at least one value.
     */
    #[JsonProperty('usage'), ArrayType(['string'])]
    public ?array $usage;

    /**
     * @param array{
     *   nickname?: ?string,
     *   financialInstitution?: ?string,
     *   accountType?: ?string,
     *   accountNumber?: ?string,
     *   routingNumber?: ?string,
     *   usage?: ?array<value-of<PaymentMethodUsage>>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->nickname = $values['nickname'] ?? null;
        $this->financialInstitution = $values['financialInstitution'] ?? null;
        $this->accountType = $values['accountType'] ?? null;
        $this->accountNumber = $values['accountNumber'] ?? null;
        $this->routingNumber = $values['routingNumber'] ?? null;
        $this->usage = $values['usage'] ?? null;
    }
}
