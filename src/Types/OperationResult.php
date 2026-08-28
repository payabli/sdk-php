<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

class OperationResult extends JsonSerializableType
{
    /**
     * @var bool $success Indicates whether the operation was successful.
     */
    #[JsonProperty('success')]
    public bool $success;

    /**
     * @var string $message A status message describing the result.
     */
    #[JsonProperty('message')]
    public string $message;

    /**
     * @var string $link The secure link the vendor uses to view their virtual card details. Empty when the operation fails.
     */
    #[JsonProperty('link')]
    public string $link;

    /**
     * @param array{
     *   success: bool,
     *   message: string,
     *   link: string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->success = $values['success'];
        $this->message = $values['message'];
        $this->link = $values['link'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
