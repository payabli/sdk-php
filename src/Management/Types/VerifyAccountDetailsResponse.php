<?php

namespace Payabli\Management\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * Response wrapper for the bank account verification details endpoint.
 */
class VerifyAccountDetailsResponse extends JsonSerializableType
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
     * @var ?BankAccountVerificationDetailsResponse $responseData
     */
    #[JsonProperty('responseData')]
    public ?BankAccountVerificationDetailsResponse $responseData;

    /**
     * @param array{
     *   responseText: string,
     *   isSuccess?: ?bool,
     *   responseData?: ?BankAccountVerificationDetailsResponse,
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
