<?php

namespace Payabli\Types;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Core\Json\JsonProperty;

/**
 * Standard boarding response envelope wrapping a deactivated payment method.
 */
class PaymentMethodDeactivatedEnvelope extends JsonSerializableType
{
    /**
     * @var bool $success Whether the request succeeded.
     */
    #[JsonProperty('success')]
    public bool $success;

    /**
     * @var ?string $message A human-readable result message.
     */
    #[JsonProperty('message')]
    public ?string $message;

    /**
     * @var ?string $traceId The trace identifier for the request, useful for support.
     */
    #[JsonProperty('traceId')]
    public ?string $traceId;

    /**
     * @var ?PaymentMethodResult $data The deactivated payment method.
     */
    #[JsonProperty('data')]
    public ?PaymentMethodResult $data;

    /**
     * @param array{
     *   success: bool,
     *   message?: ?string,
     *   traceId?: ?string,
     *   data?: ?PaymentMethodResult,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->success = $values['success'];
        $this->message = $values['message'] ?? null;
        $this->traceId = $values['traceId'] ?? null;
        $this->data = $values['data'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
