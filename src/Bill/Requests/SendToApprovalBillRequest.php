<?php

namespace Payabli\Bill\Requests;

use Payabli\Core\Json\JsonSerializableType;

class SendToApprovalBillRequest extends JsonSerializableType
{
    /**
     * @var ?bool $autocreateUser Automatically create the target user for approval if they don't exist.
     */
    public ?bool $autocreateUser;

    /**
     * @var ?string $idempotencyKey _Optional but recommended_ A unique ID that you can include to prevent duplicating objects or transactions in the case that a request is sent more than once. This key isn't generated in Payabli, you must generate it yourself. This key persists for 2 minutes. After 2 minutes, you can reuse the key if needed.
     */
    public ?string $idempotencyKey;

    /**
     * @var array<string> $body
     */
    public array $body;

    /**
     * @param array{
     *   body: array<string>,
     *   autocreateUser?: ?bool,
     *   idempotencyKey?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->autocreateUser = $values['autocreateUser'] ?? null;
        $this->idempotencyKey = $values['idempotencyKey'] ?? null;
        $this->body = $values['body'];
    }
}
