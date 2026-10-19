<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * Response for canceling a ghost card.
 */
class DeleteGhostCardResponse extends JsonSerializableType
{
    /**
     * @var ?bool $isSuccess
     */
    #[JsonProperty('isSuccess')]
    public ?bool $isSuccess;

    /**
     * @var ?DeleteGhostCardResponseData $responseData
     */
    #[JsonProperty('responseData')]
    public ?DeleteGhostCardResponseData $responseData;

    /**
     * @param array{
     *   isSuccess?: ?bool,
     *   responseData?: ?DeleteGhostCardResponseData,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->isSuccess = $values['isSuccess'] ?? null;
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
