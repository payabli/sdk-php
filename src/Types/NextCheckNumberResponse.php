<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * Response body for the next check number lookup.
 */
class NextCheckNumberResponse extends JsonSerializableType
{
    /**
     * @var string $checkNumber The suggested next check number for the paypoint and funding account. Payabli returns the highest check number on the account's check payouts plus one, or `1` if the account has no check history. Canceled check payouts don't count.
     */
    #[JsonProperty('checkNumber')]
    public string $checkNumber;

    /**
     * @param array{
     *   checkNumber: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->checkNumber = $values['checkNumber'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
