<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Core\Types\ArrayType;

/**
 * The Pay In and Pay Out services the bank account applies to. Include at least one entry across the two lists.
 */
class BankAccountServices extends JsonSerializableType
{
    /**
     * @var ?array<value-of<MoneyInService>> $moneyIn Pay In services the account is used for.
     */
    #[JsonProperty('moneyIn'), ArrayType(['string'])]
    public ?array $moneyIn;

    /**
     * @var ?array<value-of<MoneyOutService>> $moneyOut Pay Out services the account is used for.
     */
    #[JsonProperty('moneyOut'), ArrayType(['string'])]
    public ?array $moneyOut;

    /**
     * @param array{
     *   moneyIn?: ?array<value-of<MoneyInService>>,
     *   moneyOut?: ?array<value-of<MoneyOutService>>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->moneyIn = $values['moneyIn'] ?? null;
        $this->moneyOut = $values['moneyOut'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
