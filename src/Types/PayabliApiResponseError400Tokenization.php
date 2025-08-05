<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

class PayabliApiResponseError400Tokenization extends JsonSerializableType
{
    /**
     * @var ?string $responseText Response text for request. Explains the reason for the error.
     */
    #[JsonProperty('responseText')]
    public ?string $responseText;

    /**
     * @param array{
     *   responseText?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->responseText = $values['responseText'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
