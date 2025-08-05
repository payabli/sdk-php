<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;
use Payabli\Core\Types\ArrayType;
use Payabli\Core\Types\Union;

/**
 * The response for canceling a single payout transaction.
 */
class PayabliApiResponseCancelListPayouts extends JsonSerializableType
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
     * @var ?string $pageIdentifier
     */
    #[JsonProperty('pageIdentifier')]
    public ?string $pageIdentifier;

    /**
     * @var ?int $responseCode
     */
    #[JsonProperty('responseCode')]
    public ?int $responseCode;

    /**
     * @var ?array<?PayabliApiResponse0ResponseData> $responseData
     */
    #[JsonProperty('responseData'), ArrayType([new Union(PayabliApiResponse0ResponseData::class, 'null')])]
    public ?array $responseData;

    /**
     * @param array{
     *   isSuccess?: ?bool,
     *   responseText?: ?string,
     *   pageIdentifier?: ?string,
     *   responseCode?: ?int,
     *   responseData?: ?array<?PayabliApiResponse0ResponseData>,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->isSuccess = $values['isSuccess'] ?? null;
        $this->responseText = $values['responseText'] ?? null;
        $this->pageIdentifier = $values['pageIdentifier'] ?? null;
        $this->responseCode = $values['responseCode'] ?? null;
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
