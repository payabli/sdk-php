<?php

namespace Payabli\PayoutSubscription\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * Success response
 */
class GetPayoutSubscriptionResponse extends JsonSerializableType
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
     * @var ?PayoutSubscriptionQueryRecord $responseData The payout subscription record.
     */
    #[JsonProperty('responseData')]
    public ?PayoutSubscriptionQueryRecord $responseData;

    /**
     * @param array{
     *   responseText: string,
     *   isSuccess?: ?bool,
     *   responseData?: ?PayoutSubscriptionQueryRecord,
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
