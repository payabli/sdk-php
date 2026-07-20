<?php

namespace Payabli\HostedPaymentPages\Requests;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Types\PayabliPages;

class NewPageRequest extends JsonSerializableType
{
    /**
     * @var ?string $idempotencyKey _Optional but recommended_ A unique ID that you can include to prevent duplicating objects or transactions in the case that a request is sent more than once. This key isn't generated in Payabli, you must generate it yourself. This key persists for 2 minutes. After 2 minutes, you can reuse the key if needed.
     */
    public ?string $idempotencyKey;

    /**
     * @var PayabliPages $body
     */
    public PayabliPages $body;

    /**
     * @param array{
     *   body: PayabliPages,
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
