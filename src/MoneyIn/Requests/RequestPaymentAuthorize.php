<?php

namespace Payabli\MoneyIn\Requests;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Types\TransRequestBody;

class RequestPaymentAuthorize extends JsonSerializableType
{
    /**
     * @var ?bool $forceCustomerCreation When `true`, the request creates a new customer record, regardless of whether customer identifiers match an existing customer. Defaults to `false`.
     */
    public ?bool $forceCustomerCreation;

    /**
     * @var ?string $idempotencyKey _Optional but recommended_ A unique ID that you can include to prevent duplicating objects or transactions in the case that a request is sent more than once. This key isn't generated in Payabli, you must generate it yourself. This key persists for 2 minutes. After 2 minutes, you can reuse the key if needed.
     */
    public ?string $idempotencyKey;

    /**
     * @var TransRequestBody $body
     */
    public TransRequestBody $body;

    /**
     * @param array{
     *   body: TransRequestBody,
     *   forceCustomerCreation?: ?bool,
     *   idempotencyKey?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->forceCustomerCreation = $values['forceCustomerCreation'] ?? null;
        $this->idempotencyKey = $values['idempotencyKey'] ?? null;
        $this->body = $values['body'];
    }
}
