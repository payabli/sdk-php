<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * General response for certain `moneyIn` and `moneyOut` endpoints.
 */
class PayabliApiResponse0 extends JsonSerializableType
{
    /**
     * @var ?bool $isSuccess
     */
    #[JsonProperty('isSuccess')]
    public ?bool $isSuccess;

    /**
     * @var ?string $pageIdentifier
     */
    #[JsonProperty('pageIdentifier')]
    public ?string $pageIdentifier;

    /**
     * @var ?PayabliApiResponse0ResponseData $responseData
     */
    #[JsonProperty('responseData')]
    public ?PayabliApiResponse0ResponseData $responseData;

    /**
     * @var ?string $responseText
     */
    #[JsonProperty('responseText')]
    public ?string $responseText;

    /**
     * @param array{
     *   isSuccess?: ?bool,
     *   pageIdentifier?: ?string,
     *   responseData?: ?PayabliApiResponse0ResponseData,
     *   responseText?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->isSuccess = $values['isSuccess'] ?? null;
        $this->pageIdentifier = $values['pageIdentifier'] ?? null;
        $this->responseData = $values['responseData'] ?? null;
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
