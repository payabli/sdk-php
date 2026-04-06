<?php

namespace Payabli\PayoutSubscription\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * Success response
 */
class AddPayoutSubscriptionResponse extends JsonSerializableType
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
     * @var int $responseData The identifier of the newly created payout subscription.
     */
    #[JsonProperty('responseData')]
    public int $responseData;

    /**
     * @var ?int $customerId The identifier of the vendor associated with the payout subscription.
     */
    #[JsonProperty('customerId')]
    public ?int $customerId;

    /**
     * @param array{
     *   responseText: string,
     *   responseData: int,
     *   isSuccess?: ?bool,
     *   customerId?: ?int,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->isSuccess = $values['isSuccess'] ?? null;
        $this->responseText = $values['responseText'];
        $this->responseData = $values['responseData'];
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
