<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * Shape returned by every Payabli API error response. The `responseData`
 * object carries human-readable error context.
 */
class PayabliErrorBody extends JsonSerializableType
{
    /**
     * @var bool $isSuccess Always `false` for error responses.
     */
    #[JsonProperty('isSuccess')]
    public bool $isSuccess;

    /**
     * Code for the response. Learn more in
     * [API Response Codes](/developers/api-reference/api-responses).
     *
     * @var ?int $responseCode
     */
    #[JsonProperty('responseCode')]
    public ?int $responseCode;

    /**
     * @var string $responseText Error text describing what went wrong.
     */
    #[JsonProperty('responseText')]
    public string $responseText;

    /**
     * @var ?PayabliErrorBodyResponseData $responseData Object with detailed error context.
     */
    #[JsonProperty('responseData')]
    public ?PayabliErrorBodyResponseData $responseData;

    /**
     * @param array{
     *   isSuccess: bool,
     *   responseText: string,
     *   responseCode?: ?int,
     *   responseData?: ?PayabliErrorBodyResponseData,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->isSuccess = $values['isSuccess'];
        $this->responseCode = $values['responseCode'] ?? null;
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
