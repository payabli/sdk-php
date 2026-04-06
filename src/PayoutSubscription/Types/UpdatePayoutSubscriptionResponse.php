<?php

namespace Payabli\PayoutSubscription\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * Success response
 */
class UpdatePayoutSubscriptionResponse extends JsonSerializableType
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
     *
     * If `isSuccess` = true, this contains the payout subscription ID. When the subscription is paused, it also includes a description (for example, "42 paused").
     *
     * If `isSuccess` = false, this contains the reason for the failure.
     *
     * @var ?string $responseData
     */
    #[JsonProperty('responseData')]
    public ?string $responseData;

    /**
     * @var ?int $customerId
     */
    #[JsonProperty('customerId')]
    public ?int $customerId;

    /**
     * @param array{
     *   responseText: string,
     *   isSuccess?: ?bool,
     *   responseData?: ?string,
     *   customerId?: ?int,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->isSuccess = $values['isSuccess'] ?? null;
        $this->responseText = $values['responseText'];
        $this->responseData = $values['responseData'] ?? null;
        $this->customerId = $values['customerId'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
