<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

class Cash extends JsonSerializableType
{
    /**
     * @var value-of<CashMethod> $method Method to use for the transaction. For cash transactions, use `cash`.
     */
    #[JsonProperty('method')]
    public string $method;

    /**
     * @param array{
     *   method: value-of<CashMethod>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->method = $values['method'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
