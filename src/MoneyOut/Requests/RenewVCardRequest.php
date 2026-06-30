<?php

namespace Payabli\MoneyOut\Requests;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

class RenewVCardRequest extends JsonSerializableType
{
    /**
     * @var string $expirationDate The new expiration date for the virtual card, in `MM-YYYY` or `MM/YYYY` format. The card expires on the last day of the month you specify. The date can't be more than 2 years and 363 days in the future.
     */
    #[JsonProperty('expirationDate')]
    public string $expirationDate;

    /**
     * @param array{
     *   expirationDate: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->expirationDate = $values['expirationDate'];
    }
}
