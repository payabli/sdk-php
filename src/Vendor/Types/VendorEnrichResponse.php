<?php

namespace Payabli\Vendor\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * Response from the vendor enrichment endpoint.
 */
class VendorEnrichResponse extends JsonSerializableType
{
    /**
     * @var ?int $responseCode
     */
    #[JsonProperty('responseCode')]
    public ?int $responseCode;

    /**
     * @var ?string $pageIdentifier
     */
    #[JsonProperty('pageIdentifier')]
    public ?string $pageIdentifier;

    /**
     * @var ?int $roomId
     */
    #[JsonProperty('roomId')]
    public ?int $roomId;

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
     * @var ?VendorEnrichResponseData $responseData
     */
    #[JsonProperty('responseData')]
    public ?VendorEnrichResponseData $responseData;

    /**
     * @param array{
     *   responseText: string,
     *   responseCode?: ?int,
     *   pageIdentifier?: ?string,
     *   roomId?: ?int,
     *   isSuccess?: ?bool,
     *   responseData?: ?VendorEnrichResponseData,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->responseCode = $values['responseCode'] ?? null;
        $this->pageIdentifier = $values['pageIdentifier'] ?? null;
        $this->roomId = $values['roomId'] ?? null;
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
