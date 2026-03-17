<?php

namespace Payabli\MoneyOutTypes\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

class ReissuePayoutResponse extends JsonSerializableType
{
    /**
     * @var bool $isSuccess
     */
    #[JsonProperty('isSuccess')]
    public bool $isSuccess;

    /**
     * @var int $responseCode
     */
    #[JsonProperty('responseCode')]
    public int $responseCode;

    /**
     * @var string $responseText
     */
    #[JsonProperty('responseText')]
    public string $responseText;

    /**
     * @var ReissuePayoutResponseData $responseData
     */
    #[JsonProperty('responseData')]
    public ReissuePayoutResponseData $responseData;

    /**
     * @param array{
     *   isSuccess: bool,
     *   responseCode: int,
     *   responseText: string,
     *   responseData: ReissuePayoutResponseData,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->isSuccess = $values['isSuccess'];
        $this->responseCode = $values['responseCode'];
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
