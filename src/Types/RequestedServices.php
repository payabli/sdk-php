<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Core\Types\ArrayType;

/**
 * The services the application requests, grouped by direction. Values are
 * case-insensitive on input and returned in the casing shown.
 */
class RequestedServices extends JsonSerializableType
{
    /**
     * @var ?array<value-of<MoneyInService>> $moneyIn The Pay In services to request.
     */
    #[JsonProperty('moneyIn'), ArrayType(['string'])]
    public ?array $moneyIn;

    /**
     * @var ?array<value-of<MoneyOutService>> $moneyOut The Pay Out services to request.
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
