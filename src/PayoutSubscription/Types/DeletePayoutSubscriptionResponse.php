<?php

namespace Payabli\PayoutSubscription\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * Success response
 */
class DeletePayoutSubscriptionResponse extends JsonSerializableType
{
    /**
     * @var ?bool $isSuccess
     */
    #[JsonProperty('isSuccess')]
    public ?bool $isSuccess;

    /**
     *
     * If `isSuccess` = true, this contains the identifier of the payout subscription.
     *
     * If `isSuccess` = false, this contains the reason for the failure.
     *
     * @var ?string $responseData
     */
    #[JsonProperty('responseData')]
    public ?string $responseData;

    /**
     * @var string $responseText
     */
    #[JsonProperty('responseText')]
    public string $responseText;

    /**
     * @param array{
     *   responseText: string,
     *   isSuccess?: ?bool,
     *   responseData?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->isSuccess = $values['isSuccess'] ?? null;
        $this->responseData = $values['responseData'] ?? null;
        $this->responseText = $values['responseText'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
