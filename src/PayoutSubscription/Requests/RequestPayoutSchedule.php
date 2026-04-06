<?php

namespace Payabli\PayoutSubscription\Requests;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\PayoutSubscription\Types\PayoutSubscriptionRequestBody;

class RequestPayoutSchedule extends JsonSerializableType
{
    /**
     * @var ?string $idempotencyKey
     */
    public ?string $idempotencyKey;

    /**
     * @var PayoutSubscriptionRequestBody $body
     */
    public PayoutSubscriptionRequestBody $body;

    /**
     * @param array{
     *   body: PayoutSubscriptionRequestBody,
     *   idempotencyKey?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->idempotencyKey = $values['idempotencyKey'] ?? null;
        $this->body = $values['body'];
    }
}
