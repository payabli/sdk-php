<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

class ConfigureApplePayOrganizationApiResponse extends JsonSerializableType
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
     * @var ?int $responseCode
     */
    #[JsonProperty('responseCode')]
    public ?int $responseCode;

    /**
     * @var ?ApplePayOrganizationUpdateData $responseData
     */
    #[JsonProperty('responseData')]
    public ?ApplePayOrganizationUpdateData $responseData;

    /**
     * @var ?string $responseText
     */
    #[JsonProperty('responseText')]
    public ?string $responseText;

    /**
     * @param array{
     *   isSuccess?: ?bool,
     *   pageIdentifier?: ?string,
     *   responseCode?: ?int,
     *   responseData?: ?ApplePayOrganizationUpdateData,
     *   responseText?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->isSuccess = $values['isSuccess'] ?? null;
        $this->pageIdentifier = $values['pageIdentifier'] ?? null;
        $this->responseCode = $values['responseCode'] ?? null;
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
