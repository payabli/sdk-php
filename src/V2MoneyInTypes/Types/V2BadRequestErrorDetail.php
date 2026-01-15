<?php

namespace Payabli\V2MoneyInTypes\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * Individual field error detail for bad request responses.
 */
class V2BadRequestErrorDetail extends JsonSerializableType
{
    /**
     * @var string $message Description of the validation error.
     */
    #[JsonProperty('message')]
    public string $message;

    /**
     * @var string $suggestion Suggested action to fix the error.
     */
    #[JsonProperty('suggestion')]
    public string $suggestion;

    /**
     * @param array{
     *   message: string,
     *   suggestion: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->message = $values['message'];
        $this->suggestion = $values['suggestion'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
