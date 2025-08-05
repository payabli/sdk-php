<?php

namespace Payabli\LineItem\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

class DeleteItemResponse extends JsonSerializableType
{
    /**
     * @var ?bool $isSuccess
     */
    #[JsonProperty('isSuccess')]
    public ?bool $isSuccess;

    /**
     * @var ?string $responseText
     */
    #[JsonProperty('responseText')]
    public ?string $responseText;

    /**
     * @param array{
     *   isSuccess?: ?bool,
     *   responseText?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->isSuccess = $values['isSuccess'] ?? null;
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
