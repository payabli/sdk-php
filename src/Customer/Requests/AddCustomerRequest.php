<?php

namespace Payabli\Customer\Requests;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Types\CustomerData;

class AddCustomerRequest extends JsonSerializableType
{
    /**
     * @var ?bool $forceCustomerCreation When `true`, the request creates a new customer record, regardless of whether customer identifiers match an existing customer.
     */
    public ?bool $forceCustomerCreation;

    /**
     * @var ?int $replaceExisting Flag indicating to replace existing customer with a new record. Possible values: 0 (don't replace), 1 (replace). Default is `0`.
     */
    public ?int $replaceExisting;

    /**
     * @var ?string $idempotencyKey _Optional but recommended_ A unique ID that you can include to prevent duplicating objects or transactions in the case that a request is sent more than once. This key isn't generated in Payabli, you must generate it yourself. This key persists for 2 minutes. After 2 minutes, you can reuse the key if needed.
     */
    public ?string $idempotencyKey;

    /**
     * @var CustomerData $body
     */
    public CustomerData $body;

    /**
     * @param array{
     *   body: CustomerData,
     *   forceCustomerCreation?: ?bool,
     *   replaceExisting?: ?int,
     *   idempotencyKey?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->forceCustomerCreation = $values['forceCustomerCreation'] ?? null;
        $this->replaceExisting = $values['replaceExisting'] ?? null;
        $this->idempotencyKey = $values['idempotencyKey'] ?? null;
        $this->body = $values['body'];
    }
}
