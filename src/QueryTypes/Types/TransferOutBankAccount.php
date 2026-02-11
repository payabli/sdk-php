<?php

namespace Payabli\QueryTypes\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * Bank account information for an outbound transfer.
 */
class TransferOutBankAccount extends JsonSerializableType
{
    /**
     * @var ?string $accountNumber The masked bank account number.
     */
    #[JsonProperty('accountNumber')]
    public ?string $accountNumber;

    /**
     * @var ?string $routingNumber The bank routing number.
     */
    #[JsonProperty('routingNumber')]
    public ?string $routingNumber;

    /**
     * @var ?string $bankName The bank name.
     */
    #[JsonProperty('bankName')]
    public ?string $bankName;

    /**
     * @param array{
     *   accountNumber?: ?string,
     *   routingNumber?: ?string,
     *   bankName?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->accountNumber = $values['accountNumber'] ?? null;
        $this->routingNumber = $values['routingNumber'] ?? null;
        $this->bankName = $values['bankName'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
