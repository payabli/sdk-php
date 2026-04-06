<?php

namespace Payabli\GhostCard\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * Response for creating a ghost card.
 */
class CreateGhostCardResponse extends JsonSerializableType
{
    /**
     * @var ?bool $isSuccess
     */
    #[JsonProperty('isSuccess')]
    public ?bool $isSuccess;

    /**
     * @var string $responseText
     */
    #[JsonProperty('responseText')]
    public string $responseText;

    /**
     * @var ?CreateGhostCardResponseData $responseData
     */
    #[JsonProperty('responseData')]
    public ?CreateGhostCardResponseData $responseData;

    /**
     * @param array{
     *   responseText: string,
     *   isSuccess?: ?bool,
     *   responseData?: ?CreateGhostCardResponseData,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->isSuccess = $values['isSuccess'] ?? null;
        $this->responseText = $values['responseText'];
        $this->responseData = $values['responseData'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
