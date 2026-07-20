<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

class RenewVCardResponse extends JsonSerializableType
{
    /**
     * @var string $responseText
     */
    #[JsonProperty('responseText')]
    public string $responseText;

    /**
     * @var bool $isSuccess
     */
    #[JsonProperty('isSuccess')]
    public bool $isSuccess;

    /**
     * @var RenewVCardResponseData $responseData
     */
    #[JsonProperty('responseData')]
    public RenewVCardResponseData $responseData;

    /**
     * @param array{
     *   responseText: string,
     *   isSuccess: bool,
     *   responseData: RenewVCardResponseData,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->responseText = $values['responseText'];
        $this->isSuccess = $values['isSuccess'];
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
