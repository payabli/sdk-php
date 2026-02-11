<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

class TransferBankAccount extends JsonSerializableType
{
    /**
     * @var string $accountNumber
     */
    #[JsonProperty('accountNumber')]
    public string $accountNumber;

    /**
     * @var string $routingNumber
     */
    #[JsonProperty('routingNumber')]
    public string $routingNumber;

    /**
     * @var string $bankName
     */
    #[JsonProperty('bankName')]
    public string $bankName;

    /**
     * @param array{
     *   accountNumber: string,
     *   routingNumber: string,
     *   bankName: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->accountNumber = $values['accountNumber'];
        $this->routingNumber = $values['routingNumber'];
        $this->bankName = $values['bankName'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
