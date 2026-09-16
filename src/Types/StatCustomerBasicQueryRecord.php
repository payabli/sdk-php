<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

class StatCustomerBasicQueryRecord extends JsonSerializableType
{
    /**
     * @var string $statX The time bucket for this row, formatted according to the query's `freq` (for example, `2026-9` for a monthly bucket). The response returns one object per bucket across the requested range.
     */
    #[JsonProperty('statX')]
    public string $statX;

    /**
     * @var int $inTransactions Count of the customer's approved transactions.
     */
    #[JsonProperty('inTransactions')]
    public int $inTransactions;

    /**
     * @var float $inTransactionsVolume Total gross value of the customer's approved transactions. Unlike `/Statistic/basic`, this volume is the gross amount, before fees.
     */
    #[JsonProperty('inTransactionsVolume')]
    public float $inTransactionsVolume;

    /**
     * @param array{
     *   statX: string,
     *   inTransactions: int,
     *   inTransactionsVolume: float,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->statX = $values['statX'];
        $this->inTransactions = $values['inTransactions'];
        $this->inTransactionsVolume = $values['inTransactionsVolume'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
