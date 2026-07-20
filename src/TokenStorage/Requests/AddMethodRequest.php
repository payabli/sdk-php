<?php

namespace Payabli\TokenStorage\Requests;

use Payabli\Core\Json\JsonSerializableType;
use Payabli\Types\RequestTokenStorage;

class AddMethodRequest extends JsonSerializableType
{
    /**
     * @var ?bool $achValidation When `true`, enables real-time validation of ACH account and routing numbers. This is an add-on feature, contact Payabli for more information.
     */
    public ?bool $achValidation;

    /**
     * @var ?bool $createAnonymous When `true`, creates a saved method with no associated customer information. The token will be associated with customer information the first time it's used to make a payment. Defaults to `false`.
     */
    public ?bool $createAnonymous;

    /**
     * @var ?bool $forceCustomerCreation When `true`, the request creates a new customer record, regardless of whether customer identifiers match an existing customer. Defaults to `false`.
     */
    public ?bool $forceCustomerCreation;

    /**
     * @var ?bool $temporary Creates a temporary, one-time-use token for the payment method that expires in 12 hours. Defaults to `false`.
     */
    public ?bool $temporary;

    /**
     * @var ?string $idempotencyKey _Optional but recommended_ A unique ID that you can include to prevent duplicating objects or transactions in the case that a request is sent more than once. This key isn't generated in Payabli, you must generate it yourself. This key persists for 2 minutes. After 2 minutes, you can reuse the key if needed.
     */
    public ?string $idempotencyKey;

    /**
     * @var RequestTokenStorage $body
     */
    public RequestTokenStorage $body;

    /**
     * @param array{
     *   body: RequestTokenStorage,
     *   achValidation?: ?bool,
     *   createAnonymous?: ?bool,
     *   forceCustomerCreation?: ?bool,
     *   temporary?: ?bool,
     *   idempotencyKey?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->achValidation = $values['achValidation'] ?? null;
        $this->createAnonymous = $values['createAnonymous'] ?? null;
        $this->forceCustomerCreation = $values['forceCustomerCreation'] ?? null;
        $this->temporary = $values['temporary'] ?? null;
        $this->idempotencyKey = $values['idempotencyKey'] ?? null;
        $this->body = $values['body'];
    }
}
