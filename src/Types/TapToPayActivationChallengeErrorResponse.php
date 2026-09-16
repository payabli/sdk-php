<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * Error response for a Tap to Pay activation challenge request.
 * `responseData` carries the same status code as the HTTP response
 * and a message describing the refusal.
 */
class TapToPayActivationChallengeErrorResponse extends JsonSerializableType
{
    /**
     * @var bool $isSuccess
     */
    #[JsonProperty('isSuccess')]
    public bool $isSuccess;

    /**
     * @var string $responseText
     */
    #[JsonProperty('responseText')]
    public string $responseText;

    /**
     * @var TapToPayActivationChallengeErrorResponseResponseData $responseData
     */
    #[JsonProperty('responseData')]
    public TapToPayActivationChallengeErrorResponseResponseData $responseData;

    /**
     * @param array{
     *   isSuccess: bool,
     *   responseText: string,
     *   responseData: TapToPayActivationChallengeErrorResponseResponseData,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->isSuccess = $values['isSuccess'];
        $this->responseText = $values['responseText'];
        $this->responseData = $values['responseData'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
